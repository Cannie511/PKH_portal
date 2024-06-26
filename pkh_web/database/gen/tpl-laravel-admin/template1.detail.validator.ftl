<#import "/lib.ftl" as lib>
<#import "/template1.lib.ftl" as tplLib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>

import org.apache.commons.lang.StringUtils;
import org.springframework.stereotype.Component;
import org.springframework.validation.Errors;
import org.springframework.validation.Validator;

import ${lib.projectPackage}.core.component.definition.MessageId;
import ${lib.projectPackage}.core.component.definition.Messages;
import ${lib.projectPackage}.core.component.util.StandardValidationUtils;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}EditParam;

/**
 *
 * ${simpleName}.
 * <p>${lib.getValueOf(fileSettings, "description")}</p>
 *
 * @author ${lib.author}
 *
 */
@Component
public class ${moduleName}Validator implements Validator {

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see org.springframework.validation.Validator#supports(java.lang.Class)
	 */
	@Override
	public boolean supports(Class<?> clazz) {

		return true;
	}

	/**
	 *
	 * {@inheritDoc}
	 *
	 * @see org.springframework.validation.Validator#validate(java.lang.Object,
	 *      org.springframework.validation.Errors)
	 */
	@Override
	public void validate(Object target, Errors errors) {

		if (target instanceof ${moduleName}EditParam) {
			${moduleName}EditParam param = (${moduleName}EditParam) target;
			validateCreate(param, errors);
		}

	}

	/**
	 *
	 * Validation create user.
	 *
	 * @param target
	 * @param errors
	 */
	public void validateCreate(${moduleName}EditParam target, Errors errors) {

		<#list entityDesc.ownEntityPropertyDescs as property>
			<#if lib.isRecordHeader(property.columnName) == false >
				<#if property.propertyClassName == 'java.lang.String' >
		if (!StandardValidationUtils.isValidTextRequired(target.get${property.name?cap_first}())) {
			errors.reject("${property.name?uncap_first}", Messages.getMessage(MessageId.V0000001,
					"${moduleName}_LABEL_${property.columnName?upper_case}"));
		}
				</#if>
			</#if>
		</#list>
	}
}
