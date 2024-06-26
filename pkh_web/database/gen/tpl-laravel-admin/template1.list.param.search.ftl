<#import "/lib.ftl" as lib>
<#import "/template1.lib.ftl" as tplLib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>


import lombok.Getter;
import lombok.Setter;
import ${lib.projectPackage}.domain.common.mvc.sv.param.SearchParam;

/**
 *
 * ${simpleName}.
 * <p>${lib.getValueOf(fileSettings, "description")}</p>
 *
 * @author ${lib.author}
 *
 */
@Getter
@Setter
public class ${moduleName}SearchParam extends SearchParam {

	<#assign searchPropList = tplLib.getSearchProperty(entityDesc.ownEntityPropertyDescs)  />
	<#list searchPropList as property>
		<#if property.id >
	private ${property.propertyClassName?keep_after("java.lang.")} ${property.name};
		</#if>
		<#if property.propertyClassName == 'java.lang.String' >
	private String ${property.name};
		</#if>
	</#list>
}