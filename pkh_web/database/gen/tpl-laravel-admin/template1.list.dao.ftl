<#import "/lib.ftl" as lib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>
import java.util.List;

import org.seasar.doma.Dao;
import org.seasar.doma.Select;
import org.seasar.doma.jdbc.SelectOptions;

import com.ichivina.doma.annotation.InjectConfig;
import ${entityClass};
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.db.query.${moduleName}FilterQuery;

/**
 *
 * ${simpleName}.
 * <p>${lib.getValueOf(fileSettings, "description")}</p>
 *
 * @author ${lib.author}
 *
 */
@Dao
@InjectConfig
public interface ${moduleName}Dao {
	@Select
	List<${entityName}> selectByFilter(${moduleName}FilterQuery query, SelectOptions options);
}
