<#import "/lib.ftl" as lib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import ${lib.projectPackage}.core.component.definition.MessageId;
import ${lib.projectPackage}.core.component.exception.BusinessException;
import ${lib.projectPackage}.core.mvc.sv.model.MessageModel;
import ${lib.projectPackage}.core.component.definition.Route;
import ${lib.projectPackage}.core.mvc.sv.model.BaseModel;
import ${lib.projectPackage}.domain.common.mvc.sv.model.BaseSearchSettingModel;
import ${lib.projectPackage}.domain.common.mvc.sv.model.SearchResultModel;
import ${lib.projectPackage}.web.com.com0000.mvc.ui.controller.BaseController;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.model.${moduleName}ItemModel;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}DeleteParam;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}SearchParam;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.service.${moduleName}Service;

/**
 *
 * ${simpleName}.
 * <p>${lib.getValueOf(fileSettings, "description")}</p>
 *
 * @author ${lib.author}
 *
 */
@RequestMapping(Route.${moduleName})
public class ${moduleName}Controller extends BaseController {

	@Autowired
	${moduleName}Service ${moduleNameCamel}Service;

	/**
	 *
	 * Init page.
	 *
	 * @param model
	 * @return
	 */
	@RequestMapping(method = RequestMethod.GET)
	public String init(Model model) {

		BaseSearchSettingModel initSetting = new BaseSearchSettingModel();
		initSetting.setCallInit(false);
		initSetting.setUrl(Route.${moduleName});
		initSetting.setActionSearch(Route.ACTION_SEARCH);
		model.addAttribute("initSetting", initSetting);
		return "${moduleNameCamel[0..2]}/${moduleName}";
	}

	/**
	 *
	 * Search list.
	 *
	 * @param param
	 * @return
	 */
	@RequestMapping(method = RequestMethod.POST, value = Route.ACTION_SEARCH)
	public @ResponseBody String search(@RequestBody ${moduleName}SearchParam param) {
		SearchResultModel<${moduleName}ItemModel> model = null;

		try {
			model = ${moduleNameCamel}Service.search(param);
		} catch (BusinessException ex) {
			model = new SearchResultModel<${moduleName}ItemModel>();
			model.setMessage(MessageModel.fail(MessageId.F0000001));
		}

		return json(model);
	}

	@RequestMapping(method = RequestMethod.POST, value = Route.ACTION_DELETE)
	public @ResponseBody String delete(@RequestBody ${moduleName}DeleteParam param) {
		BaseModel model = null;

		try {
			model = ${moduleNameCamel}Service.delete(param);
		} catch (BusinessException ex) {
			model = new BaseModel();
			model.setMessage(MessageModel.fail(MessageId.F0000001));
		}

		return json(model);
	}
}
