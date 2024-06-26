<#import "/lib.ftl" as lib>
<#import "/template1.lib.ftl" as tplLib>
<#assign baseUrl = lib.getValueOf(fileSettings, "baseUrl")>
<#assign parentModuleName = lib.getValueOf(fileSettings, "parentModuleName")>
<#assign subModuleCode = lib.getValueOf(fileSettings, "subModuleCode")>
<%@ page language="java" contentType="text/html; charset=utf-8"
	pageEncoding="utf-8"%>
<%@ include file="/WEB-INF/views/common/taglib.inc" %>
<c:set var="baseUrl"><c:url value="/resources"></c:url></c:set>

<c:if test="${r"${initSetting.screenMode eq 'CREATE' }"}">
	<c:set var="title" value="${moduleName}_TITLE_CREATE" />
</c:if>
<c:if test="${r"${initSetting.screenMode eq 'EDIT' }"}">
	<c:set var="title" value="${moduleName}_TITLE_EDIT" />
</c:if>

<app:Html module="app">
	<app:Head title="${r"${title }"}">

	</app:Head>

	<app:BodyTheme controller="BaseEditCtrl"
		init="init(${r"${ helper:json(initSetting) })"}">
		<app:Layout>

			<app:PageHead title="${r"${title}"}">
			</app:PageHead>

			<%-- BEGIN PAGE CONTENT BODY --%>
			<div class="page-content">
				<div class="container-fluid">
					<%-- BEGIN PAGE BREADCRUMBS --%>
					<ul class="page-breadcrumb breadcrumb">
						<li><a href="index.html"><i class="fa fa-home"></i></a> <i class="fa fa-circle"></i></li>
						<li><span><spring:message code="${r"${title }"}" /></span></li>
					</ul>
					<%-- END PAGE BREADCRUMBS --%>
					<%-- BEGIN PAGE CONTENT INNER --%>
					<div class="page-content-inner">
						<div class="row">
							<div class="col-md-12">
								<div class="portlet light ">
									<div class="portlet-title">
										<div class="caption font-green">
											<i class="icon-list font-green"></i>&nbsp;<span
												class="caption-subject bold uppercase"><spring:message
													code="${moduleName}_TITLE" /></span></span>
										</div>
									</div>
									<div class="portlet-body form">
										<div class="alert alert-danger" ng-if="m.fieldErrors.__COMMON">
											<span class="help-block m-b-none text-danger"
												ng-repeat="msg in m.fieldErrors.__COMMON">{{msg}}</span>
										</div>

										<div class="alert alert-danger" ng-if="m.setting.screenMode == 'ERROR'">
											<span class="help-block m-b-none text-danger">{{m.msg}}</span>
										</div>

										<div class="alert alert-info"
											ng-if="m.setting.screenMode == 'CONFIRM'">
											<span class="help-block m-b-none text-info"><spring:message
													code="I0000009" /></span>
										</div>

										<div class="form-body" ng-if="m.setting.screenMode == 'ERROR'">
											<a href="<c:url value="${baseUrl}"/>" class="btn btn-default">
												<spring:message code="COMMON_BUTTON_BACK" />
											</a>
										</div>

										<form class="form-horizontal" method="post" ng-submit="save()">
											<div class="form-body">
												<#assign editPropList = entityDesc.idEntityPropertyDescs  />
												<#list editPropList as property >
												<div class="form-group">
													<label class="col-md-2 control-label"><spring:message
															code="${moduleName}_LABEL_${property.columnName?upper_case}" /></label>
													<div class="col-md-6">
														<p class="form-control-static" ng-hide="m.form.${property.name}">-</p>
														<p class="form-control-static" ng-if="m.form.${property.name}">{{m.form.${property.name}}}</p>
													</div>
												</div>											
												</#list>

												<#assign editPropList = tplLib.getEditProperty(entityDesc.ownEntityPropertyDescs)  />
												<#list editPropList as property >
													<@tplLib.printEditField property=property moduleName=moduleName/>	
												</#list>
											</div>

											<div class="form-actions">
												<div class="form-group">
													<div class="col-sm-4 col-sm-offset-2"
														ng-if="m.setting.screenMode == 'CREATE' || m.setting.screenMode == 'EDIT'">
														<a href="<c:url value="/${parentModuleName}${subModuleCode}00"/>" class="btn btn-default btn-width-default">
															<spring:message code="COMMON_BUTTON_BACK" />
														</a>
														<button type="submit" class="btn green btn-width-default">
															<i class="fa fa-save"></i>&nbsp;<spring:message code="COMMON_BUTTON_SAVE" />
														</button>
													</div>
													<div class="col-sm-4 col-sm-offset-2"
														ng-if="m.setting.screenMode == 'CONFIRM'">
														<a href="#" class="btn btn-default btn-width-default" ng-click="editMode($event)">
															<i class="fa fa-edit"></i>&nbsp;<spring:message code="COMMON_BUTTON_EDIT" />
														</a>
														<button type="submit" class="btn green btn-width-default">
															<i class="fa fa-check"></i>&nbsp;<spring:message code="COMMON_BUTTON_CONFIRM" />
														</button>
													</div>
												</div>
											</div>
										</form>

									</div>
								</div>
							</div>
						</div>
					</div>
					<%-- END PAGE CONTENT INNER --%>
				</div>
			</div>
			<%-- END PAGE CONTENT BODY --%>

		</app:Layout>

		<app:Script>

		</app:Script>

	</app:BodyTheme>

</app:Html>

<!-- Properites

${moduleName[0..2]}_TITLE=${moduleName[0..2]}_TITLE
${moduleName}_TITLE_CREATE=${moduleName}.TITLE_CREATE
${moduleName}_TITLE_EDIT=${moduleName}_TITLE_EDIT

<#list entityDesc.ownEntityPropertyDescs as property>
	<#if lib.isRecordHeader(property.columnName) == false >
${moduleName}_LABEL_${property.columnName?upper_case}=${property.name}
	</#if>
</#list>
-->
