<?php
namespace distributor\solvers;

class Test extends \distributor\Solver
{
    public function solve(&$users, &$groups, $weighter)
	{
        foreach($users as &$user)
        {
            foreach($user->get_chosen_groups() as &$group)
            {
                if(!$group->is_full())
                {
                    $user->set_assigned_group($group);
                    break;
                }
            }
        }
	}
}

?>