<#import "/lib.ftl" as lib>
<#import "/template1.lib.ftl" as tplLib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>


import java.util.ArrayList;
import java.util.List;

import org.seasar.doma.jdbc.SelectOptions;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.util.CollectionUtils;

import ${entityClass};
import ${lib.projectPackage}.core.component.definition.MessageId;
import ${lib.projectPackage}.core.component.definition.Messages;
import ${lib.projectPackage}.core.component.util.SqlUtils;
import ${lib.projectPackage}.core.component.util.PaginationUtils;
import ${lib.projectPackage}.core.component.definition.MessageId;
import ${lib.projectPackage}.core.component.definition.Messages;
import ${lib.projectPackage}.core.mvc.bl.dto.PaginationDto;
import ${lib.projectPackage}.core.mvc.sv.model.MessageModel;
import ${lib.projectPackage}.core.mvc.sv.model.BaseModel;
import ${lib.projectPackage}.domain.common.mvc.sv.model.SearchResultModel;
import ${lib.projectPackage}.domain.data.dao.${lib.tableNamePascal(tableName)?trim}Dao;
import ${lib.projectPackage}.domain.common.mvc.sv.service.BaseService;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.db.dao.${moduleName}Dao;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.db.query.${moduleName}FilterQuery;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.model.${moduleName}ItemModel;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}DeleteParam;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}SearchParam;

/**
 *
 * ${moduleName}ServiceImpl.
 *
 * @author Nguyen Phu Cuong
 *
 */
public class ${moduleName}ServiceImpl extends BaseService implements ${moduleName}Service {

	@Autowired
	${moduleName}Dao ${moduleNameCamel}Dao;

	@Autowired
	${lib.tableNamePascal(tableName)?trim}Dao ${lib.tableNamePascal(tableName)?trim?uncap_first}Dao;

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see ${lib.projectPackage}.web.admin.${moduleNameCamel}.mvc.sv.service.AUSR0100Service#search(${lib.projectPackage}.web.admin.ausr0100.mvc.sv.param.AUSR0100SearchParam)
	 */
	@Override
	public SearchResultModel<${moduleName}ItemModel> search(${moduleName}SearchParam param) {

		SearchResultModel<${moduleName}ItemModel> result = new SearchResultModel<${moduleName}ItemModel>();

		${moduleName}FilterQuery query = new ${moduleName}FilterQuery();
		<#list entityDesc.ownEntityPropertyDescs as property>
			<#if lib.isRecordHeader(property.columnName) == false >
				<#if property.id >
		query.set${property.name?cap_first}(param.get${property.name?cap_first}());
				</#if>
				<#if property.propertyClassName == 'java.lang.String' >
		query.set${property.name?cap_first}(${lib.toString(property, "param")});
				</#if>
			</#if>
		</#list>
		query.setOrderBy(SqlUtils.getOrderByString(param.getOrderBy(),
		param.getOrderDirection(), <#list entityDesc.idEntityPropertyDescs as property>"${property.columnName}"<#sep>, </#sep></#list>));

		SelectOptions options = PaginationUtils.getSelectOptions(
				param.getPage(), param.getPageSize());

		List<${entityName}> listItem = ${moduleNameCamel}Dao.selectByFilter(query, options);

		PaginationDto pagerDto = PaginationUtils
				.getPaginationInfo(param.getPage(), param.getPageSize(),
						options.getCount());
		result.setPaginationInfo(pagerDto);

		if (!CollectionUtils.isEmpty(listItem)) {
			List<${moduleName}ItemModel> listItemResult = new ArrayList<${moduleName}ItemModel>();
			for(${entityName} item : listItem){
				${moduleName}ItemModel itemModel= new ${moduleName}ItemModel();
				<#list entityDesc.ownEntityPropertyDescs as property>
					<#if lib.isRecordHeader(property.columnName) == false >
					${lib.copyProperty2String('itemModel', 'item', property, '')}
					</#if>
				</#list>
				listItemResult.add(itemModel);
			}
			result.setResult(listItemResult);
		}

		result.setMessage(MessageModel.ok());
		return result;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see ${lib.projectPackage}.web.admin.${moduleNameCamel}.mvc.sv.service.${moduleName}Service#delete(${lib.projectPackage}.web.admin.${moduleNameCamel}.mvc.sv.param.${moduleName}DeleteParam)
	 */
	@Override
	public BaseModel delete(${moduleName}DeleteParam param) {
		BaseModel result = new BaseModel();

		int records = ${lib.tableNamePascal(tableName)?trim?uncap_first}Dao.deleteById(<#list entityDesc.idEntityPropertyDescs as property>param.get${property.name?cap_first}()<#sep>, </#sep></#list>);

		if (records == 1) {
			result.setMessage(MessageModel.ok(Messages.getMessage(
					MessageId.I0000002, "${tableName}",
					<#list entityDesc.idEntityPropertyDescs as property>String.valueOf(param.get${property.name?cap_first}())<#sep>, </#sep></#list>)));
		} else {
			result.setMessage(MessageModel.fail(Messages.getMessage(
					MessageId.E0000004, "${tableName}",
					<#list entityDesc.idEntityPropertyDescs as property>String.valueOf(param.get${property.name?cap_first}())<#sep>, </#sep></#list>)));
		}

		return result;
	}
}
