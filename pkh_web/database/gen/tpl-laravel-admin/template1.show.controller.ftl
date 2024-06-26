<#import "/lib.ftl" as lib>
<#import "/template1.lib.ftl" as tplLib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;
import org.springframework.web.bind.annotation.ResponseBody;

import ${lib.projectPackage}.core.component.definition.Constants;
import ${lib.projectPackage}.core.component.definition.MessageId;
import ${lib.projectPackage}.core.component.definition.Route;
import ${lib.projectPackage}.core.component.exception.BusinessException;
import ${lib.projectPackage}.core.mvc.sv.model.MessageModel;
import ${lib.projectPackage}.domain.common.mvc.sv.model.BaseCreateSettingModel;
import ${lib.projectPackage}.web.com.com0000.mvc.ui.controller.BaseController;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.model.${moduleName}LoadModel;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}LoadParam;
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
	private ${moduleName}Service ${moduleNameCamel}Service;

	/**
	 *
	 * Load view page
	 *
	 * @param model
	 * @return
	 */
	@RequestMapping(method = RequestMethod.GET, value = "/{id}")
	public String view(@ModelAttribute("id") String id, Model model) {

		BaseCreateSettingModel initSetting = new BaseCreateSettingModel();
		initSetting.setLoadUrl(Route.${moduleName} + Route.ACTION_LOAD);
		initSetting.setScreenMode(Constants.SCREEN_MODE_VIEW);
		initSetting.setRedirectUrl(Route.${tplLib.getListModule(moduleName)});

		${moduleName}LoadParam loadParam = new ${moduleName}LoadParam();
		<#list entityDesc.idEntityPropertyDescs as property>
		loadParam.set${property.name?cap_first}(id);
		</#list>
		

		initSetting.setLoadParam(loadParam);

		model.addAttribute("initSetting", initSetting);
		return "${moduleName[0..2]?lower_case}/${tplLib.getShowModule(moduleName)}";
	}

	/**
	 *
	 * load entity.
	 *
	 * @param param
	 * @param result
	 * @return
	 * @throws Exception
	 */
	@RequestMapping(method = RequestMethod.POST, value = Route.ACTION_LOAD)
	public @ResponseBody String load(@RequestBody ${moduleName}LoadParam param)
			throws Exception {

		${moduleName}LoadModel model = null;

		try {
			model = ${moduleNameCamel}Service.load(param);
		} catch (BusinessException ex) {
			model = new ${moduleName}LoadModel();
			model.setMessage(MessageModel.fail(MessageId.F0000001));
		}

		return json(model);
	}

}
