<#import "/lib.ftl" as lib>
<#import "/template1.lib.ftl" as tplLib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>

import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.model.${moduleName}LoadModel;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}LoadParam;

/**
 *
 * ${simpleName}.
 * <p>${lib.getValueOf(fileSettings, "description")}</p>
 *
 * @author ${lib.author}
 *
 */
public interface ${moduleName}Service {

	/**
	 *
	 * Load user
	 *
	 * @param param
	 * @return
	 */
	${moduleName}LoadModel load(${moduleName}LoadParam param);

}
