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
import ${lib.projectPackage}.core.mvc.sv.model.BaseModel;

/**
 *
 * ${simpleName}.
 * <p>${lib.getValueOf(fileSettings, "description")}</p>
 *
 * @author ${lib.author}
 *
 */
@SuppressWarnings("serial")
@Getter
@Setter
public class ${moduleName}LoadModel extends BaseModel {
	<#assign editPropList = tplLib.getEditPropertyWithId(entityDesc.ownEntityPropertyDescs)  />
	<#list editPropList as property>
	private String ${property.name};
	</#list>
}
