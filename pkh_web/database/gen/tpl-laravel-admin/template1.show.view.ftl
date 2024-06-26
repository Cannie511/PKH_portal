<#import "/lib.ftl" as lib>
<#import "/template1.lib.ftl" as tplLib>
<#assign baseUrl = lib.getValueOf(fileSettings, "baseUrl")>
<#assign parentModuleName = lib.getValueOf(fileSettings, "parentModuleName")>
<#assign subModuleCode = lib.getValueOf(fileSettings, "subModuleCode")>

<%@ page language="java" contentType="text/html; charset=utf-8"
	pageEncoding="utf-8"%>
<%@ include file="/WEB-INF/views/common/taglib.inc" %>
<c:set var="baseUrl"><c:url value="/resources"></c:url></c:set>

<app:Html module="app">
	<app:Head title="${moduleName}_TITLE">

	</app:Head>

	<app:BodyTheme controller="BaseShowCtrl"
		init="init(${r"${ helper:json(initSetting) })"}">
		<app:Layout>

			<app:PageHead title="${moduleName}_TITLE">
			</app:PageHead>

			<%-- BEGIN PAGE CONTENT BODY --%>
			<div class="page-content">
				<div class="container-fluid">
					<%-- BEGIN PAGE BREADCRUMBS --%>
					<ul class="page-breadcrumb breadcrumb">
						<li><a href="index.html"><i class="fa fa-home"></i></a> <i class="fa fa-circle"></i></li>
						<li><span><spring:message code="${moduleName}_TITLE" /></span></li>
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
										
										<div class="alert alert-danger" ng-if="m.setting.screenMode == 'ERROR'">
											<span class="help-block m-b-none text-danger">{{m.msg}}</span>
										</div>

										<div class="panel-body" ng-if="m.setting.screenMode == 'ERROR'">
											<a href="<c:url value="/${parentModuleName}${subModuleCode}00"/>" class="btn btn-default">
												<spring:message code="COMMON_BUTTON_BACK" />
											</a>
										</div>

										<form class="form-horizontal" method="post">
											<div class="form-body">
												<#assign editPropList = entityDesc.idEntityPropertyDescs  />
												<#list editPropList as property >
												<div class="form-group">
													<label class="col-md-2 control-label"><spring:message
															code="${moduleName}_LABEL_${property.columnName?upper_case}" /></label>
													<div class="col-md-6">
														<p class="form-control-static">{{m.form.${property.name}}}</p>
													</div>
												</div>											
												</#list>

												<#assign editPropList = tplLib.getEditProperty(entityDesc.ownEntityPropertyDescs)  />
												<#list editPropList as property >
													<@tplLib.printStaticField property=property moduleName=moduleName/>	
												</#list>
											</div>

											<div class="form-actions">
												<div class="form-group">
													<div class="col-sm-4 col-sm-offset-2">
														<a href="<c:url value="/${parentModuleName}${subModuleCode}00"/>" class="btn btn-default btn-width-default">
															<spring:message code="COMMON_BUTTON_BACK" />
														</a>
														<a href="<c:url value="/${parentModuleName}${subModuleCode}10/Edit"/><#list entityDesc.ownEntityPropertyDescs as property><#if property.id>/{{item.${property.name}}}<#break></#if></#list>" class="btn btn-success btn-width-default">
															<i class="fa fa-edit"></i>&nbsp;<spring:message code="COMMON_BUTTON_EDIT" />
														</a>
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
${moduleName}_TITLE=${moduleName}_TITLE

<#list entityDesc.ownEntityPropertyDescs as property>
	<#if lib.isRecordHeader(property.columnName) == false >
${moduleName}_LABEL_${property.columnName?upper_case}=${property.name}
	</#if>
</#list>
-->
