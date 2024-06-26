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

	<app:BodyTheme controller="BaseSearchCtrl"
		init="init(${r"${ helper:json(initSetting) }"})">
		<app:Layout>
			<app:PageHead title="${moduleName[0..2]}_TITLE" subTitle="${moduleName}_TITLE">
			</app:PageHead>

			<%-- BEGIN PAGE CONTENT BODY --%>
			<div class="page-content">
				<div class="container-fluid">
					<%-- BEGIN PAGE BREADCRUMBS --%>
					<ul class="page-breadcrumb breadcrumb">
						<li><a href="<c:url value="/"/>"><i class="fa fa-home"></i></a> <i class="fa fa-circle"></i></li>
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
										<div class="actions">
											<div class="btn-group">
												<a href="<c:url value="${parentModuleName}${subModuleCode}10/Create"/>" class="btn green btn-width-default"><i class="icon-plus"></i>&nbsp;<spring:message
														code="COMMON_BUTTON_ADD" /></a>
											</div>
										</div>
									</div>
									<div class="portlet-body form">
										<form role="form" ng-submit="search(1)">
											<#assign loopIndex = "0">
											<#assign searchPropList = tplLib.getSearchProperty(entityDesc.ownEntityPropertyDescs)  />
											<#list searchPropList >
											<div class="row wrapper">
												<#items as property>
															<#if loopIndex?number gt 0 && loopIndex?number % 4 == 0 >
											</div>
											<div class="row wrapper">
															</#if>
															<#assign loopIndex = "${loopIndex?number + 1}">
												<div class="col-md-3 col-sm-6 m-b-xs">
													<div class="form-group">
														<label><spring:message code="${moduleName}_LABEL_${property.columnName?upper_case}" /></label>
														<input type="text" ng-model="m.filter.${property.name}" class="form-control"
															placeholder='<spring:message code="${moduleName}_LABEL_${property.columnName?upper_case}" />'>
													</div>
												</div>
												</#items>
											</div>

											</#list>

											<div class="row">
												<div class="col-md-12">
													<button type="submit" class="btn default btn-width-default">
														<i class="icon-magnifier"></i>&nbsp;
														<spring:message code="COMMON_BUTTON_SEARCH" />
													</button>
												</div>
											</div>
										</form>
									</div>

									<div class="portlet-body">
										<div class="table-responsive">
											<table class="table table-striped b-t b-light">
												<thead>
													<tr>
														<#list entityDesc.ownEntityPropertyDescs as property>
															<#if lib.isRecordHeader(property.columnName) == false >
														<th ng-click="sort('${property.columnName}');" class="sortable">
															<spring:message code="${moduleName}_LABEL_${property.columnName?upper_case}" />
															<exex-sortable order-by="m.filter.orderBy" column-name="'${property.columnName}'"
																order-direction="m.filter.orderDirection"></exex-sortable>
														</th>
															</#if>
														</#list>
														<th class="col-action"></th>
													</tr>
												</thead>
												<tbody ng-if="m.list">
													<tr ng-repeat='item in m.list'>
														<#list entityDesc.ownEntityPropertyDescs as property>
															<#if lib.isRecordHeader(property.columnName) == false >
														<td>{{item.${property.name}}}</td>
															</#if>
														</#list>

														<td>
															<button type="button" class="btn btn-default btn-sm"
																data-animation="am-flip-x" bs-dropdown
																aria-haspopup="true" aria-expanded="false"
																placement="bottom-right">
																<i class="icon-options-vertical"></i>
															</button>
															<ul class="dropdown-menu" role="menu">
																<li><a
																	href="<c:url value="/${parentModuleName}${subModuleCode}20"/><#list entityDesc.ownEntityPropertyDescs as property><#if property.id>/{{item.${property.name}}}<#break></#if></#list>"><i
																		class="fa fa-eye"></i>&nbsp;<spring:message
																			code="COMMON_BUTTON_VIEW" /></a></li>
																<li><a
																	href="<c:url value="/${parentModuleName}${subModuleCode}10/Edit"/><#list entityDesc.ownEntityPropertyDescs as property><#if property.id>/{{item.${property.name}}}<#break></#if></#list>"><i
																		class="fa fa-edit"></i>&nbsp;<spring:message
																			code="COMMON_BUTTON_EDIT" /></a></li>
																<li><a href="#"
																	ng-click="confirmDelete($event, item, <#list entityDesc.ownEntityPropertyDescs as property><#if property.id>{${property.name}: item.${property.name}}, item.${property.name}<#break></#if></#list>)"><i
																		class="fa fa-remove"></i>&nbsp;<spring:message
																			code="COMMON_BUTTON_DELETE" /></a></li>
															</ul>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="portlet-body page-list-footer">
										<div class="row wrapper" ng-if="m.paginationInfo.totalRecord == 0">
											<div class="col-sm-12">
												<span class="text-warning"><spring:message code="W0000001" /></span>
											</div>
										</div>

										<div class="row" ng-if="m.paginationInfo.totalRecord > 0">
											<div class="col-sm-4 hidden-xs">
												<select ng-model="m.paginationInfo.pageSize"
													class="input-sm form-control w-sm inline v-middle ctrl-page-size"
													ng-change="changePageSize()"
													ng-options="item as item for item in m.listPageSize">
												</select>
											</div>

											<div class="col-sm-4 text-center">
												<small class="text-muted inline m-t-sm m-b-sm">{{m.paginationInfo.from}}-{{m.paginationInfo.to}}/{{m.paginationInfo.totalRecord}}</small>
											</div>

											<div class="col-sm-4 text-right text-center-xs">
												<pagination ng-show="m.paginationInfo.page > 0"
													total-items="m.paginationInfo.totalRecord"
													ng-model="m.paginationInfo.page"
													items-per-page="m.paginationInfo.pageSize"
													ng-change="doSearch(m.paginationInfo.page)"
													class="pagination pagination-sm m-t-none m-b-none">
												</pagination>
											</div>
										</div>
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
