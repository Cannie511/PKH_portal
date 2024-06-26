<#assign copyright>
/**
 * Copyright(c) Phan Khang Home Co. VN, Ltd. All Rights Reserved.
 */
</#assign>
<#assign author="Nguyen Phu Cuong">
<#assign projectPackage="com.ichivina.dms">

<#function isRecordHeader columnName>
	<#if columnName == 'cre_func_id' ||
         columnName == 'cre_ts' ||
         columnName == 'cre_user_id' ||
         columnName == 'mod_func_id' ||
         columnName == 'mod_ts' ||
         columnName == 'mod_user_id' ||
         columnName == 'version_no' ||
         columnName == 'del_flg' >
         <#return true>
    </#if>
	<#return false>
</#function>

<#function getValueOf list key>
	<#list list as item>
	    <#if item.key == key>
	    	<#return item.value>
	    </#if>
	</#list>
	<#return "">
</#function>

<#function tableNamePascal tableName>
	<#assign tableNameDao><#list tableName?split("_") as x>${x?cap_first}</#list></#assign>
	<#return tableNameDao>
</#function>

<#function copyProperty var1 var2 property var2Type>
	<#switch var2Type>
		<#case 'String'>
	<#return var1 + ".set" + property.name?cap_first + "(String.valueOf(" + var2  + ".get" + property.name?cap_first + "()));">
		<#default>
	<#return var1 + ".set" + property.name?cap_first + "(" + var2  + ".get" + property.name?cap_first + "());">
	</#switch>

</#function>

<#function copyProperty2String var1 var2 property var2Type>
	<#switch var2Type>
		<#case 'String'>
	<#return var1 + ".set" + property.name?cap_first + "(String.valueOf(" + var2  + ".get" + property.name?cap_first + "()));">
		<#default>
	<#return var1 + ".set" + property.name?cap_first + "(" + toString(property, var2) + ");">
	</#switch>

</#function>

<#function toString property varName>
	<#local result = ""/>
	<#if property.propertyClassName == "java.lang.String">
		<#local result = varName + ".get" + property.name?cap_first + "()"/>
	<#else>
		<#local result = "String.valueOf(" + varName + ".get" + property.name?cap_first + "())"/>
	</#if>
	<#return result>
</#function>

<#function isFillableColumn column>
	<#if column.columnName == 'created_at' ||
         column.columnName == 'created_by' ||
         column.columnName == 'updated_at' ||
         column.columnName == 'updated_by' ||
         column.columnName == 'version_no' ||
         column.columnName == 'active_flg'>
         <#return false>
    </#if>
	<#return true>
</#function>