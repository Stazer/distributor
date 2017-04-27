<?php
namespace distributor;

class Testing
{
    /**
     * Returns all users with an unsatisfying choice
     *
     * @param $users Array of users
     *
     * @return Array of users whichs choice is unsatisfying
     */
    public static function get_unsatisfied_users($users)
    {
        $unsatisfied_users = [];

        foreach($users as & $user)
        {
            if(!$user->is_choice_satisfied())
                $unsatisfied_users[] = &$user;
        }

        return $unsatisfied_users;
    }

    /**
     * Returns the satisfaction analysis
     *
     * @param $users Array of users
     *
     * @return Array of satisfaction levels which each user is assigned to (zero for no satisfaction, one for best satisfaction)
     */
    public static function get_satisfaction_analysis($users)
    {
        $satisfaction = [];

        foreach($users as & $user)
        {
            $choice_satisfaction = $user->get_choice_satisfaction();

            if(($i = count($satisfaction)) < $choice_satisfaction)
            {
                for(; $i < $choice_satisfaction; ++$i)
                    $satisfaction[] = [];
            }

            $satisfaction[$choice_satisfaction][] = & $user; 
        }

        return $satisfaction;
    }
}