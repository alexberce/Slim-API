<?php


namespace Invobox\Api\Resources;


use Invobox\Api\Model\ModelInterface;

interface ResourceModelInterface extends ModelInterface
{
	function expose();
}