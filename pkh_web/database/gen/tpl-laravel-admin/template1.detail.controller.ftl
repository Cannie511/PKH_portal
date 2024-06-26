<#import "/lib.ftl" as lib>
<#import "/template1.lib.ftl" as tplLib>
<#if lib.copyright??>
${lib.copyright}
</#if>
<#if packageName??>
package ${packageName};
</#if>

import javax.validation.Valid;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.ui.Model;
import org.springframework.validation.BindingResult;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.InitBinder;
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
import ${lib.projectPackage}.core.mvc.sv.model.BaseModel;
import ${lib.projectPackage}.domain.common.mvc.sv.model.BaseCreateSettingModel;
import ${lib.projectPackage}.web.com.com0000.mvc.ui.controller.BaseController;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.model.${moduleName}LoadModel;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}EditParam;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.param.${moduleName}LoadParam;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.sv.service.${moduleName}Service;
import ${lib.projectPackage}.web.${moduleNameCamel[0..2]}.${moduleNameCamel}.mvc.ui.validator.${moduleName}Validator;

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
	private ${moduleName}Validator ${moduleNameCamel}Validator;

	@Autowired
	private ${moduleName}Service ${moduleNameCamel}Service;

	@InitBinder()
	public void initBinder(final WebDataBinder binder) {

		binder.setValidator(${moduleNameCamel}Validator);
	}

	/**
	 *
	 * Load create page
	 *
	 * @param model
	 * @return
	 */
	@RequestMapping(method = RequestMethod.GET, value = Route.ACTION_CREATE)
	public String create(Model model) {

		BaseCreateSettingModel initSetting = new BaseCreateSettingModel();
		initSetting.setUrl(Route.${moduleName} + Route.ACTION_CREATE);
		initSetting.setScreenMode(Constants.SCREEN_MODE_CREATE);
		initSetting.setRedirectUrl(Route.${tplLib.getListModule(moduleName)});
		model.addAttribute("initSetting", initSetting);
		return "${moduleName[0..2]?lower_case}/${moduleName}";
	}

	/**
	 *
	 * Create entity.
	 *
	 * @param param
	 * @param result
	 * @return
	 * @throws Exception
	 */
	@RequestMapping(method = RequestMethod.POST, value = Route.ACTION_CREATE)
	public @ResponseBody String create(
			@RequestBody @Valid ${moduleName}EditParam param, BindingResult result)
			throws Exception {

		BaseModel model = null;

		try {
			model = ${moduleNameCamel}Service.create(param);
		} catch (BusinessException ex) {
			model = new BaseModel();
			model.setMessage(MessageModel.fail(MessageId.F0000001));
		}

		return json(model);
	}

	/**
	 *
	 * Load edit page
	 *
	 * @param model
	 * @return
	 */
	@RequestMapping(method = RequestMethod.GET, value = Route.ACTION_EDIT
			+ "/{id}")
	public String edit(@ModelAttribute("id") String id, Model model) {

		BaseCreateSettingModel initSetting = new BaseCreateSettingModel();
		initSetting.setUrl(Route.${moduleName} + Route.ACTION_EDIT);
		initSetting.setLoadUrl(Route.${moduleName} + Route.ACTION_LOAD);
		initSetting.setScreenMode(Constants.SCREEN_MODE_EDIT);
		initSetting.setRedirectUrl(Route.${tplLib.getListModule(moduleName)});

		${moduleName}LoadParam loadParam = new ${moduleName}LoadParam();
		<#list entityDesc.idEntityPropertyDescs as property>
		loadParam.set${property.name?cap_first}(id);
		</#list>

		initSetting.setLoadParam(loadParam);

		model.addAttribute("initSetting", initSetting);
		return "${moduleName[0..2]?lower_case}/${moduleName}";
	}

	/**
	 *
	 * Create entity.
	 *
	 * @param param
	 * @param result
	 * @return
	 * @throws Exception
	 */
	@RequestMapping(method = RequestMethod.POST, value = Route.ACTION_EDIT)
	public @ResponseBody String edit(
			@RequestBody @Valid ${moduleName}EditParam param, BindingResult result)
			throws Exception {

		BaseModel model = null;

		try {
			model = ${moduleNameCamel}Service.save(param);
		} catch (BusinessException ex) {
			model = new BaseModel();
			model.setMessage(MessageModel.fail(MessageId.F0000001));
		}

		return json(model);
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
