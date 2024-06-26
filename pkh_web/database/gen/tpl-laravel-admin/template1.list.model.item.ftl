<#import "/lib.ftl" as lib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>


import lombok.Getter;
import lombok.Setter;
import ${lib.projectPackage}.core.mvc.sv.model.AbstractModel;

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
public class ${moduleName}ItemModel extends AbstractModel {

	<#list entityDesc.ownEntityPropertyDescs as property>
		<#if lib.isRecordHeader(property.columnName) == false >
	private String ${property.name};
		</#if>
	</#list>

}
