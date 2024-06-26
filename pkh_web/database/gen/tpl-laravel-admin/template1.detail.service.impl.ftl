<#import "/lib.ftl" as lib>
<#import "/template1.lib.ftl" as tplLib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>

import java.security.NoSuchAlgorithmException;
import java.security.spec.InvalidKeySpecException;
import java.time.LocalDateTime;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.util.StringUtils;

import ${lib.projectPackage}.core.component.definition.Constants;
import ${lib.projectPackage}.core.component.definition.MessageId;
import ${lib.projectPackage}.core.component.definition.Messages;
import ${lib.projectPackage}.core.component.session.LogonSession;
import ${lib.projectPackage}.core.component.util.LocalDateUtils;
import ${lib.projectPackage}.core.mvc.sv.model.MessageModel;
import ${lib.projectPackage}.domain.common.mvc.sv.service.BaseService;
import ${lib.projectPackage}.domain.data.dao.SequenceMstDao;
import ${lib.projectPackage}.domain.data.dao.${lib.tableNamePascal(tableName)?trim}Dao;
import ${lib.projectPackage}.domain.data.entity.${lib.tableNamePascal(tableName)?trim};
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.model.${moduleName}EditModel;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.model.${moduleName}LoadModel;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}EditParam;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}LoadParam;

/**
 *
 * ${simpleName}.
 * <p>${lib.getValueOf(fileSettings, "description")}</p>
 *
 * @author ${lib.author}
 *
 */
public class ${moduleName}ServiceImpl extends BaseService implements ${moduleName}Service {

	private static final String FUNCTION_ID = "${moduleName}";

	@Autowired
	${lib.tableNamePascal(tableName)?trim}Dao ${lib.tableNamePascal(tableName)?trim?uncap_first}Dao;

	@Autowired
	SequenceMstDao sequenceMstDao;

	@Autowired
	LogonSession logonSession;

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see ${lib.projectPackage}.web.admin.${moduleNameCamel}.mvc.sv.service.${moduleName}Service#create(${lib.projectPackage}.web.admin.${moduleNameCamel}.mvc.sv.param.${moduleName}EditParam)
	 */
	@Override
	public ${moduleName}EditModel create(${moduleName}EditParam param) {

		${moduleName}EditModel result = new ${moduleName}EditModel();

		if (Constants.ACTION_SAVE.equals(param.getActionMode())) {
			Long nextId = sequenceMstDao.selectNext${lib.tableNamePascal(tableName)?trim}Id();

			// Create new object table
			${lib.tableNamePascal(tableName)?trim} item = new ${lib.tableNamePascal(tableName)?trim}();
			<#list entityDesc.ownEntityPropertyDescs as property>
				<#if lib.isRecordHeader(property.columnName) == false >
					<#if property.id >
			item.set${property.name?cap_first}(nextId);
					</#if>
					<#if property.propertyClassName == 'java.lang.String' >
			item.set${property.name?cap_first}(param.get${property.name?cap_first}());
					</#if>
				</#if>
			</#list>

			item.setCreFuncId(FUNCTION_ID);
			item.setCreUserId(logonSession.getUserId());
			item.setModFuncId(FUNCTION_ID);
			item.setModUserId(logonSession.getUserId());

			LocalDateTime now = LocalDateUtils.getSystemDateTime();

			item.setCreTs(now);
			item.setModTs(now);
			item.setDelFlg("0");

			int affectRow = ${lib.tableNamePascal(tableName)?trim?uncap_first}Dao.insert(item);
			if (affectRow == 1) {
				<#list entityDesc.idEntityPropertyDescs as property>//result.set${property.name?cap_first}(String.valueOf(nextId));<#break/></#list>
				result.setMessage(MessageModel.ok(Messages.getMessage(
						MessageId.I0000008, "${moduleName}.LABEL.",
						<#list entityDesc.idEntityPropertyDescs as property>String.valueOf(item.get${property.name?cap_first}()))<#sep>, </#sep></#list>));
			} else {
				result.setMessage(MessageModel.fail(Messages.getMessage(
						MessageId.E0000005, "${moduleName}.LABEL.",
						<#list entityDesc.idEntityPropertyDescs as property>String.valueOf(item.get${property.name?cap_first}()))<#sep>, </#sep></#list>));
			}
		} else {
			// Validation only
			result.setMessage(MessageModel.ok());
		}

		return result;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see ${lib.projectPackage}.web.admin.${moduleNameCamel}.mvc.sv.service.${moduleName}Service#load(${lib.projectPackage}.web.admin.${moduleNameCamel}.mvc.sv.param.${moduleName}LoadParam)
	 */
	@Override
	public ${moduleName}LoadModel load(${moduleName}LoadParam param) {
		${moduleName}LoadModel result = new ${moduleName}LoadModel();
		Long id = 0L;

		try {
			id = Long.parseLong(param.get<#list entityDesc.idEntityPropertyDescs as property>${property.name?cap_first}<#break/></#list>());
		} catch (NumberFormatException ex) {
			getLogger().warn(ex.getMessage(), ex);
		}

		if (id > 0) {

			${lib.tableNamePascal(tableName)?trim} item = ${lib.tableNamePascal(tableName)?trim?uncap_first}Dao.selectById(id);
			if (item != null) {
				result.setMessage(MessageModel.ok());

				<#list entityDesc.ownEntityPropertyDescs as property>
					<#if lib.isRecordHeader(property.columnName) == false >
						<#if property.id >
				result.set${property.name?cap_first}(String.valueOf(item.get${property.name?cap_first}()));
						</#if>
						<#if property.propertyClassName == 'java.lang.String' >
				result.set${property.name?cap_first}(item.get${property.name?cap_first}());
						</#if>
					</#if>
				</#list>
			} else {
				result.setMessage(MessageModel.fail(Messages.getMessage(
						MessageId.E0000006, "${moduleName}.LABEL.", <#list entityDesc.idEntityPropertyDescs as property>param.get${property.name?cap_first}())<#sep>, </#sep></#list>));
			}

		} else {
			result.setMessage(MessageModel.fail(Messages.getMessage(
					MessageId.E0000006, "${moduleName}.LABEL.", <#list entityDesc.idEntityPropertyDescs as property>param.get${property.name?cap_first}())<#sep>, </#sep></#list>));
		}

		return result;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see ${lib.projectPackage}.web.admin.${moduleNameCamel}.mvc.sv.service.${moduleName}Service#save(vn.sysexe.groupware.web.admin.${moduleNameCamel}.mvc.sv.param.${moduleName}EditParam)
	 */
	@Override
	public ${moduleName}EditModel save(${moduleName}EditParam param) {

		${moduleName}EditModel result = new ${moduleName}EditModel();
		Long id = 0L;

		try {
			<#list entityDesc.ownEntityPropertyDescs as property>
				<#if lib.isRecordHeader(property.columnName) == false >
					<#if property.id >
			id = Long.parseLong(param.get${property.name?cap_first}());
					</#if>
				</#if>
			</#list>
		} catch (NumberFormatException ex) {
			getLogger().warn(ex.getMessage(), ex);
		}

		if (id > 0) {

			${lib.tableNamePascal(tableName)?trim} item = ${lib.tableNamePascal(tableName)?trim?uncap_first}Dao.selectById(id);
			if (item != null) {

				<#list entityDesc.ownEntityPropertyDescs as property>
					<#if lib.isRecordHeader(property.columnName) == false >
						<#if property.propertyClassName == 'java.lang.String' >
				item.set${property.name?cap_first}(param.get${property.name?cap_first}());
						</#if>
					</#if>
				</#list>


				item.setModFuncId(FUNCTION_ID);
				item.setModUserId(logonSession.getUserId());

				item.setModTs(LocalDateUtils.getSystemDateTime());
				item.setDelFlg("0");

				${lib.tableNamePascal(tableName)?trim?uncap_first}Dao.update(item);

				result.setMessage(MessageModel.ok(Messages.getMessage(
						MessageId.I0000002, "${moduleName}",
						<#list entityDesc.idEntityPropertyDescs as property>param.get${property.name?cap_first}())<#sep>, </#sep></#list>));
			} else {
				result.setMessage(MessageModel.fail(Messages.getMessage(
						MessageId.E0000003, "${moduleName}",
						<#list entityDesc.idEntityPropertyDescs as property>param.get${property.name?cap_first}())<#sep>, </#sep></#list>));
			}

		} else {
			result.setMessage(MessageModel.fail(Messages.getMessage(
					MessageId.E0000003, "${moduleName}.LABEL.", <#list entityDesc.idEntityPropertyDescs as property>param.get${property.name?cap_first}()<#sep>, </#sep></#list>)));
		}

		return result;
	}
}
