<#import "/lib.ftl" as lib>
select
<#list entityDesc.ownEntityPropertyDescs as property>
  ${property.columnName}<#sep>, </#sep>
</#list>
from
  ${tableName}
where
  del_flg = '0'
  <#list entityDesc.ownEntityPropertyDescs as property>
    <#if lib.isRecordHeader(property.columnName) == false >
      <#if property.id >
  /*%if query.${property.name} != null */
    and ${property.columnName} = /* query.${property.name} */1
  /*%end */
      </#if>
      <#if property.propertyClassName == 'java.lang.String' >
  /*%if query.${property.name} != null */
    and lower(${property.columnName}) like '%' || /* query.${property.name} */'sample' || '%'
  /*%end */
      </#if>
    </#if>
  </#list>
  /*%if query.orderBy != null && query.orderBy != "" */
    /*# query.orderBy */
  /*%end */

