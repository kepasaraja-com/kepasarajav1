<?php
 namespace MailPoetVendor\Doctrine\ORM; if (!defined('ABSPATH')) exit; class EntityNotFoundException extends \MailPoetVendor\Doctrine\ORM\ORMException { public static function fromClassNameAndIdentifier($className, array $id) { $ids = []; foreach ($id as $key => $value) { $ids[] = $key . '(' . $value . ')'; } return new self('Entity of type \'' . $className . '\'' . ($ids ? ' for IDs ' . \implode(', ', $ids) : '') . ' was not found'); } } 