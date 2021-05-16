<?php
 namespace MailPoetVendor\Symfony\Component\DependencyInjection\Compiler; if (!defined('ABSPATH')) exit; use MailPoetVendor\Symfony\Component\DependencyInjection\ChildDefinition; use MailPoetVendor\Symfony\Component\DependencyInjection\ContainerInterface; use MailPoetVendor\Symfony\Component\DependencyInjection\Definition; use MailPoetVendor\Symfony\Component\DependencyInjection\Exception\ExceptionInterface; use MailPoetVendor\Symfony\Component\DependencyInjection\Exception\RuntimeException; use MailPoetVendor\Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException; class ResolveChildDefinitionsPass extends \MailPoetVendor\Symfony\Component\DependencyInjection\Compiler\AbstractRecursivePass { private $currentPath; protected function processValue($value, $isRoot = \false) { if (!$value instanceof \MailPoetVendor\Symfony\Component\DependencyInjection\Definition) { return parent::processValue($value, $isRoot); } if ($isRoot) { $value = $this->container->getDefinition($this->currentId); } if ($value instanceof \MailPoetVendor\Symfony\Component\DependencyInjection\ChildDefinition) { $this->currentPath = []; $value = $this->resolveDefinition($value); if ($isRoot) { $this->container->setDefinition($this->currentId, $value); } } return parent::processValue($value, $isRoot); } private function resolveDefinition(\MailPoetVendor\Symfony\Component\DependencyInjection\ChildDefinition $definition) : \MailPoetVendor\Symfony\Component\DependencyInjection\Definition { try { return $this->doResolveDefinition($definition); } catch (\MailPoetVendor\Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException $e) { throw $e; } catch (\MailPoetVendor\Symfony\Component\DependencyInjection\Exception\ExceptionInterface $e) { $r = new \ReflectionProperty($e, 'message'); $r->setAccessible(\true); $r->setValue($e, \sprintf('Service "%s": %s', $this->currentId, $e->getMessage())); throw $e; } } private function doResolveDefinition(\MailPoetVendor\Symfony\Component\DependencyInjection\ChildDefinition $definition) : \MailPoetVendor\Symfony\Component\DependencyInjection\Definition { if (!$this->container->has($parent = $definition->getParent())) { throw new \MailPoetVendor\Symfony\Component\DependencyInjection\Exception\RuntimeException(\sprintf('Parent definition "%s" does not exist.', $parent)); } $searchKey = \array_search($parent, $this->currentPath); $this->currentPath[] = $parent; if (\false !== $searchKey) { throw new \MailPoetVendor\Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException($parent, \array_slice($this->currentPath, $searchKey)); } $parentDef = $this->container->findDefinition($parent); if ($parentDef instanceof \MailPoetVendor\Symfony\Component\DependencyInjection\ChildDefinition) { $id = $this->currentId; $this->currentId = $parent; $parentDef = $this->resolveDefinition($parentDef); $this->container->setDefinition($parent, $parentDef); $this->currentId = $id; } $this->container->log($this, \sprintf('Resolving inheritance for "%s" (parent: %s).', $this->currentId, $parent)); $def = new \MailPoetVendor\Symfony\Component\DependencyInjection\Definition(); $def->setClass($parentDef->getClass()); $def->setArguments($parentDef->getArguments()); $def->setMethodCalls($parentDef->getMethodCalls()); $def->setProperties($parentDef->getProperties()); if ($parentDef->isDeprecated()) { $def->setDeprecated(\true, $parentDef->getDeprecationMessage('%service_id%')); } $def->setFactory($parentDef->getFactory()); $def->setConfigurator($parentDef->getConfigurator()); $def->setFile($parentDef->getFile()); $def->setPublic($parentDef->isPublic()); $def->setLazy($parentDef->isLazy()); $def->setAutowired($parentDef->isAutowired()); $def->setChanges($parentDef->getChanges()); $def->setBindings($definition->getBindings() + $parentDef->getBindings()); $changes = $definition->getChanges(); if (isset($changes['class'])) { $def->setClass($definition->getClass()); } if (isset($changes['factory'])) { $def->setFactory($definition->getFactory()); } if (isset($changes['configurator'])) { $def->setConfigurator($definition->getConfigurator()); } if (isset($changes['file'])) { $def->setFile($definition->getFile()); } if (isset($changes['public'])) { $def->setPublic($definition->isPublic()); } else { $def->setPrivate($definition->isPrivate() || $parentDef->isPrivate()); } if (isset($changes['lazy'])) { $def->setLazy($definition->isLazy()); } if (isset($changes['deprecated'])) { $def->setDeprecated($definition->isDeprecated(), $definition->getDeprecationMessage('%service_id%')); } if (isset($changes['autowired'])) { $def->setAutowired($definition->isAutowired()); } if (isset($changes['shared'])) { $def->setShared($definition->isShared()); } if (isset($changes['decorated_service'])) { $decoratedService = $definition->getDecoratedService(); if (null === $decoratedService) { $def->setDecoratedService($decoratedService); } else { $def->setDecoratedService($decoratedService[0], $decoratedService[1], $decoratedService[2], $decoratedService[3] ?? \MailPoetVendor\Symfony\Component\DependencyInjection\ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE); } } foreach ($definition->getArguments() as $k => $v) { if (\is_numeric($k)) { $def->addArgument($v); } elseif (0 === \strpos($k, 'index_')) { $def->replaceArgument((int) \substr($k, \strlen('index_')), $v); } else { $def->setArgument($k, $v); } } foreach ($definition->getProperties() as $k => $v) { $def->setProperty($k, $v); } if ($calls = $definition->getMethodCalls()) { $def->setMethodCalls(\array_merge($def->getMethodCalls(), $calls)); } $def->addError($parentDef); $def->addError($definition); $def->setAbstract($definition->isAbstract()); $def->setTags($definition->getTags()); $def->setAutoconfigured($definition->isAutoconfigured()); return $def; } } 