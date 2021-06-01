<?php
 namespace MailPoetVendor\Doctrine\ORM\Query\Exec; if (!defined('ABSPATH')) exit; use MailPoetVendor\Doctrine\DBAL\Connection; use MailPoetVendor\Doctrine\ORM\Query\AST\SelectStatement; use MailPoetVendor\Doctrine\ORM\Query\SqlWalker; class SingleSelectExecutor extends \MailPoetVendor\Doctrine\ORM\Query\Exec\AbstractSqlExecutor { public function __construct(\MailPoetVendor\Doctrine\ORM\Query\AST\SelectStatement $AST, \MailPoetVendor\Doctrine\ORM\Query\SqlWalker $sqlWalker) { $this->_sqlStatements = $sqlWalker->walkSelectStatement($AST); } public function execute(\MailPoetVendor\Doctrine\DBAL\Connection $conn, array $params, array $types) { return $conn->executeQuery($this->_sqlStatements, $params, $types, $this->queryCacheProfile); } } 