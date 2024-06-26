<#import "/lib.ftl" as lib>
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
public class ${moduleName}FilterQuery {
	<#list entityDesc.ownEntityPropertyDescs as property>
		<#if lib.isRecordHeader(property.columnName) == false >
			<#if property.id >
	private ${property.propertyClassName?keep_after("java.lang.")} ${property.name};
			</#if>
			<#if property.propertyClassName == 'java.lang.String' >
	private String ${property.name};
			</#if>
		</#if>
	</#list>
	private String orderBy;
}
