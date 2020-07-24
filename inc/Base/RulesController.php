<?php
/**
 * @package IrisnetAPIPlugin
 */
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\RulesCallbacks;
use Inc\Api\Callbacks\AdminCallbacks;

class RulesController extends BaseController
{
    private $settings;

    private $callbacks;
    private $rules_callbacks;

    private $subpages = array();

    private static $drawModeVars = array(
        0 => 'none',
        1 => 'frame + name',
        2 => 'mask',
        3 => 'blur'
    );

    private static $classObjectGroups = array(
        'checkNudity' => array (
            'face' => 'faces',
            'hand' => 'hands',
            'breast' => 'breasts',
            'vulva' => 'vulvae',
            'penis' => 'penises',
            'vagina' => 'vaginae',
            'buttocks' => 'buttocks', 
            'anus' => 'ani', 
        ),
        'ageVerification' => array(
            'child' => 'child faces',
            'adult' => 'adult faces',
            'senior' => 'senior faces',
        ),
        'illegalSymbols' => array (
            'illegalSymbols' => 'illegal symbols'
        )
    );

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->rules_callbacks = new RulesCallbacks();

        $this->setSubpages();
        
        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addSubPages($this->subpages)->register();
    }

    private function setSubpages()
    {
        $this->subpages = array(
            array(
                'parent_slug' => 'irisnet_dash',
                'page_title' => 'Rules Management',
                'menu_title' => 'Rules',
                'capability' => 'manage_options',
                'menu_slug' => 'irisnet_rules',
                'callback' => array($this->callbacks, 'adminRules')
            )
        );
    }

    private function setSettings()
    {
        $args = array(
            array(
                'option_group' => 'irisnet_plugin_rules_settings',
                'option_name' => 'irisnet_plugin_rules',
                'callback' => array( $this->rules_callbacks, 'rulesSanitize' )
            )
        );

        $this->settings->setSettings($args);
    }

    private function setSections()
    {
        $args = array(
            array(
                'id' => 'irisnet_rules_index',
                'title' => 'Add/Edit Rule',
                'callback' => array( $this->rules_callbacks, 'rulesSectionManager' ),
                'page' => 'irisnet_rules'
            )
        );

        $this->settings->setSections($args);
    }

    private function setFields()
    {

        $s = array(
            'callback' => array( $this->rules_callbacks, 'fieldsetSwitch' ),
            'args' => array(
                'class' => 'ui-toggle',
                'label_for' => 'switch'
            )
        );
        $switch = new \ArrayObject($s);

        $defaultFields = array(
            array(
                'id' => 'thresh',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'type' => 'number',
                    'step' => '.01',
                    'min' => '0',
                    'max' => '1',
                    'placeholder' => 'e.g. 0.75',
                    'array' => 'rule_name',
                    'description' => 'Threshold when an object can be recognized.',
                    'tooltip' => 'Lowering the value will increase the probability of recognizing objects. Setting the value too low however, can cause false positives.'
                )
            ),
            array(
                'id' => 'grey',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'type' => 'number',
                    'min' => '0',
                    'max' => '255',
                    'placeholder' => 'e.g. 255',
                    'array' => 'rule_name',
                    'description' => 'A grey scale color to use for frame or masking. Is only applied on the output image.',
                    'tooltip' => '0 will represent black, while the maximum 255 will be white'
                )
            )
        );

        $paramFields = array(
            array(
                'id' => 'min',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'type' => 'number',
                    'min' => '0',
                    'placeholder' => 'e.g. 0',
                    'array' => 'rule_name',
                    'description' => 'Minimum amount of classification objects that should be recognized.',
                    'tooltip' => 'Define the minimum amount that sould be found of this object to pass the check.'
                )
            ),
            array(
                'id' => 'max',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'type' => 'number',
                    'min' => '-1',
                    'placeholder' => 'e.g. 5',
                    'array' => 'rule_name',
                    'description' => 'Maximum amount of classification objects that should be recognized.',
                    'tooltip' => 'Define the maximum amount that sould be found of this object to pass the check. Use -1 to ignore the maximum count'
                )
            ),
            array(
                'id' => 'draw_mode',
                'callback' => array( $this->rules_callbacks, 'selectField' ),
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'select_options' => self::$drawModeVars,
                    'array' => 'rule_name',
                    'description' => 'The draw mode that will be used for the output media.',
                    'tooltip' => 'Is only applied on the output image.'
                )
            )
        );
        $paramFields = array_merge($paramFields, array($defaultFields[1]));

        $groupFields = array();
        foreach (self::$classObjectGroups as $groupName => $classes) {
            
            $classFields = array();
            foreach ($classes as $className => $plural) {
                $classFields[] = array(
                    'id' => $className,
                    'callback' => array( $this->rules_callbacks, 'infoText' ),
                    'page' => 'irisnet_rules',
                    'section' => 'irisnet_rules_index',
                    'args' => array(
                        'option_name' => 'irisnet_plugin_rules',
                        'title' => ucfirst($className). ' Parameters',
                        'label_for' => $className,
                        'description' => "The $className classification object parameters will apply to all recognized $plural.",
                        'fields' => $paramFields
                    )
                );
            }

            $s = $switch->getArrayCopy();
            $s['args']['option_name'] = 'irisnet_plugin_rules';
            
            $groupFields[] = array(
                'id' => $groupName,
                'title' => ucfirst($groupName),
                'callback' => array( $this->rules_callbacks, 'fieldset' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'label_for' => $groupName,
                    'switch' => $s,
                    'fields' => $classFields,
                    'extend_name' => false,
                    'compact' => true
                )
            );
        }

        $args = array(
            array(
                'id' => 'rule_name',
                'title' => 'Rule Set Name',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'label_for' => 'rule_name',
                    'required' => true,
                    'placeholder' => 'e.g. profile_picture',
                    'array' => 'rule_name',
                    'description' => 'Your custom name for the rule set.'
                )
            ),
            array(
                'id' => 'description',
                'title' => 'Description',
                'callback' => array( $this->rules_callbacks, 'textField' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'label_for' => 'description',
                    'required' => true,
                    'placeholder' => 'e.g. Allow one person to appear in the picture.',
                    'array' => 'rule_name',
                    'description' => 'Describe the characteristics of the rule set.'
                )
            ),
            array(
                'id' => 'default',
                'title' => 'Base parameters (Defaults)',
                'callback' => array( $this->rules_callbacks, 'fieldset' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'option_name' => 'irisnet_plugin_rules',
                    'label_for' => 'default',
                    'description' => 'Define base parameter settings that are valid for all of the classification objects. Single parameter settings can be still overwritten within each classification object if needed.' .
                        '<br>See INDefault Schema in <a href="https://www.irisnet.de/api" target="_blank">API Documentation</a> for further information.',
                    'switch' => $switch,
                    'fields' => $defaultFields,
                    'extend_name' => true
                )
            ),
            array(
                'id' => 'parameter_info_text',
                'callback' => array( $this->rules_callbacks, 'infoText' ),
                'page' => 'irisnet_rules',
                'section' => 'irisnet_rules_index',
                'args' => array(
                    'description' => '<b>The following options, within the toggle groups, represent the classification objects recognized by the irisnet AI. ' .
                        'Each classification or their parameter settings within can be left off or empty. In that case default settings will applied.</b>' .
                        '<br>See INParam Schema in <a href="https://www.irisnet.de/api" target="_blank">API Documentation</a> for further information ' .
                        'on each classification object and their default settings.',
                )
            )
        );
        $args = array_merge($args, $groupFields);

        $this->settings->setFields($args);
    }

    /**
     * Get the value of drawModeVars
     */ 
    public static function getDrawModeVars()
    {
        return self::$drawModeVars;
    }

    /**
     * Get the value of classObjectGroups
     */ 
    public static function getClassObjectGroups()
    {
        return self::$classObjectGroups;
    }
}
