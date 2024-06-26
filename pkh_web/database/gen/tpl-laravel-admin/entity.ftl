<?php
<#import "/lib.ftl" as lib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
namespace App\Models;
</#if>

/**
<#if showDbComment && comment??>
 * ${comment}
</#if>
<#if lib.author??>
 * @author ${lib.author}
</#if>
 *
 */
class ${simpleName} extends BaseModel {
	protected $table = "${tableName}";

	/**
     * The primary key for the model.
     *
     * @var string
     */
<#list idEntityPropertyDescs as property>
	<#if property?is_first == false>//</#if>protected $primaryKey = '${property.columnName}';
</#list>

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<#list ownEntityPropertyDescs as property>
  <#if lib.isFillableColumn(property)>
        <#if showDbComment && property.comment??>/** ${property.propertyClassSimpleName} ${property.comment} */<#else>/** ${property.propertyClassSimpleName} */</#if>
        "${property.columnName}"<#sep>,</#sep>
  </#if>
</#list>
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
    ];
}