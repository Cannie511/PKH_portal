<#import "/lib.ftl" as lib>

<#function getSearchProperty listProps>
	<#assign result = [  ] />
	<#list listProps as property>
		<#if lib.isRecordHeader(property.columnName) == false >
			<#if property.id || property.propertyClassName == 'java.lang.String' >
				<#assign result = result + [ property ] />
			</#if>
		</#if>
	</#list>
	<#return result>
</#function>

<#function getEditProperty listProps>
	<#assign result = [  ] />
	<#list listProps as property>
		<#if lib.isRecordHeader(property.columnName) == false && property.id == false >
			<#if property.propertyClassName == 'java.lang.String' || property.propertyClassName == 'java.lang.Long' >
				<#assign result = result + [ property ] />
			</#if>
		</#if>
	</#list>
	<#return result>
</#function>

<#function getEditPropertyWithId listProps>
	<#assign result = [  ] />
	<#list listProps as property>
		<#if lib.isRecordHeader(property.columnName) == false >
			<#if property.propertyClassName == 'java.lang.String' || property.propertyClassName == 'java.lang.Long' >
				<#assign result = result + [ property ] />
			</#if>
		</#if>
	</#list>
	<#return result>
</#function>

<#function getListModule moduleName>
	<#return moduleName[0..2] + "0100">
</#function>

<#function getShowModule moduleName>
	<#return moduleName[0..2] + "0120">
</#function>

<#macro printEditField property moduleName>
							<div class="form-group"
								ng-class="{'has-error': m.fieldErrors.${property.name}}">
								<label class="col-md-2 control-label field-required"><spring:message
										code="${moduleName}_LABEL_${property.columnName?upper_case}" /></label>
								<div class="col-md-6">
									<p class="form-control-static"
										ng-if="m.setting.screenMode == 'CONFIRM'">{{m.form.${property.name}}}</p>
									<input type="text" class="form-control"
										placeholder="<spring:message code="${moduleName}_LABEL_${property.columnName?upper_case}"/>"
										ng-model="m.form.${property.name}"
										ng-if="m.setting.screenMode != 'CONFIRM'" /> <span
										class="help-block m-b-none text-danger"
										ng-repeat="msg in m.fieldErrors.${property.name}">{{msg}}</span>
								</div>
							</div>
</#macro>

<#macro printStaticField property moduleName>
							<div class="form-group">
								<label class="col-md-2 control-label"><spring:message
										code="${moduleName}_LABEL_${property.columnName?upper_case}" /></label>
								<div class="col-md-6">
									<p class="form-control-static">{{m.form.${property.name}}}</p>
								</div>
							</div>
</#macro>