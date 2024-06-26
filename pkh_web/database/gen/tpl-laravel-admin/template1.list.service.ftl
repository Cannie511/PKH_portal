<#import "/lib.ftl" as lib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>


import ${lib.projectPackage}.core.mvc.sv.model.BaseModel;
import ${lib.projectPackage}.domain.common.mvc.sv.model.SearchResultModel;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.model.${moduleName}ItemModel;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}DeleteParam;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}SearchParam;

/**
 *
 * ${moduleName}Service.
 *
 * @author Nguyen Phu Cuong
 *
 */
public interface ${moduleName}Service {
	/**
	 *
	 * Search user.
	 *
	 * @param param
	 * @return
	 */
	SearchResultModel<${moduleName}ItemModel> search(${moduleName}SearchParam param);

	/**
	 *
	 * Delete user.
	 *
	 * @param param
	 * @return
	 */
	BaseModel delete(${moduleName}DeleteParam param);
}
