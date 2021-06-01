<?php
 namespace MailPoetVendor\Twig\Extension; if (!defined('ABSPATH')) exit; use MailPoetVendor\Twig\NodeVisitor\SandboxNodeVisitor; use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedMethodError; use MailPoetVendor\Twig\Sandbox\SecurityNotAllowedPropertyError; use MailPoetVendor\Twig\Sandbox\SecurityPolicyInterface; use MailPoetVendor\Twig\Source; use MailPoetVendor\Twig\TokenParser\SandboxTokenParser; final class SandboxExtension extends \MailPoetVendor\Twig\Extension\AbstractExtension { private $sandboxedGlobally; private $sandboxed; private $policy; public function __construct(\MailPoetVendor\Twig\Sandbox\SecurityPolicyInterface $policy, $sandboxed = \false) { $this->policy = $policy; $this->sandboxedGlobally = $sandboxed; } public function getTokenParsers() { return [new \MailPoetVendor\Twig\TokenParser\SandboxTokenParser()]; } public function getNodeVisitors() { return [new \MailPoetVendor\Twig\NodeVisitor\SandboxNodeVisitor()]; } public function enableSandbox() { $this->sandboxed = \true; } public function disableSandbox() { $this->sandboxed = \false; } public function isSandboxed() { return $this->sandboxedGlobally || $this->sandboxed; } public function isSandboxedGlobally() { return $this->sandboxedGlobally; } public function setSecurityPolicy(\MailPoetVendor\Twig\Sandbox\SecurityPolicyInterface $policy) { $this->policy = $policy; } public function getSecurityPolicy() { return $this->policy; } public function checkSecurity($tags, $filters, $functions) { if ($this->isSandboxed()) { $this->policy->checkSecurity($tags, $filters, $functions); } } public function checkMethodAllowed($obj, $method, int $lineno = -1, \MailPoetVendor\Twig\Source $source = null) { if ($this->isSandboxed()) { try { $this->policy->checkMethodAllowed($obj, $method); } catch (\MailPoetVendor\Twig\Sandbox\SecurityNotAllowedMethodError $e) { $e->setSourceContext($source); $e->setTemplateLine($lineno); throw $e; } } } public function checkPropertyAllowed($obj, $method, int $lineno = -1, \MailPoetVendor\Twig\Source $source = null) { if ($this->isSandboxed()) { try { $this->policy->checkPropertyAllowed($obj, $method); } catch (\MailPoetVendor\Twig\Sandbox\SecurityNotAllowedPropertyError $e) { $e->setSourceContext($source); $e->setTemplateLine($lineno); throw $e; } } } public function ensureToStringAllowed($obj, int $lineno = -1, \MailPoetVendor\Twig\Source $source = null) { if ($this->isSandboxed() && \is_object($obj) && \method_exists($obj, '__toString')) { try { $this->policy->checkMethodAllowed($obj, '__toString'); } catch (\MailPoetVendor\Twig\Sandbox\SecurityNotAllowedMethodError $e) { $e->setSourceContext($source); $e->setTemplateLine($lineno); throw $e; } } return $obj; } } \class_alias('MailPoetVendor\\Twig\\Extension\\SandboxExtension', 'MailPoetVendor\\Twig_Extension_Sandbox'); 