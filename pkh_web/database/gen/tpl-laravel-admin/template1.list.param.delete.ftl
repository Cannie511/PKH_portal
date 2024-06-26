<#import "/lib.ftl" as lib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>

import lombok.Getter;
import lombok.Setter;
import ${lib.projectPackage}.core.mvc.sv.param.AbstractParam;

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
public class ${moduleName}DeleteParam extends AbstractParam  {

	<#list entityDesc.ownEntityPropertyDescs as property>
		<#if property.id>
	private ${property.propertyClassName?keep_after("java.lang.")} ${property.name};
			<#break>
		</#if>
	</#list>
}
