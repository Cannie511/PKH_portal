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
public class ${moduleName}LoadParam {
	<#list entityDesc.idEntityPropertyDescs as property>
	private String ${property.name};
	</#list>
}