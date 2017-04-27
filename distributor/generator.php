<?php
namespace distributor;

class Generator
{
    /**
     * Generates up to $max_groups groups, each with a random limit
     *
     * @param $max_groups Maximum of generated groups
     * @param $max_users 
     * @param $prefix Prefix for group ids
     * 
     * @return Generated groups
     */
    public static function generate_random_groups($max_groups, $amount_of_users, $prefix = 'g')
    {
        $groups = [];
        
        for($i = 0; $i < $max_groups && $amount_of_users > 0; ++$i)
        {
            if($i < $max_groups - 1)
            {
                $limit = mt_rand(1, $amount_of_users);
                $amount_of_users -= $limit;
            }
            else
                $limit = $amount_of_users;
            
            $name = $prefix.$i;
            $groups[$name] = new \distributor\Group($name, $limit);
        }
        
        return $groups;
    }

    /**
     * Generates $amount_of_groups groups, each with a limit of $limit users
     *
     * @param $amount_of_groups Amount of groups that will be generated
     * @param $limit Limit that will be set to each group
     * @param $prefix Prefix for group ids
     *
     * @return Array of generated groups, each with $limit as user limit
     */
    public static function generate_groups($amount_of_groups, $limit, $prefix = 'g')
    {
        $groups = [];
        
        for($i = 0; $i < $amount_of_groups; ++$i)
        {
            $name = $prefix.$i;
            $groups[$name] = new \distributor\Group($name, $limit);
        }

        return $groups;
    }

    /**
     * Generates $amount_of_users users
     *
     * @param $amount_of_users Amount of users
     * @param $prefix Prefix for user ids
     *
     * @return Array of generated users
     */
    public static function generate_users($amount_of_users, $prefix = 'u')
    {
        $users = [];

        for($i = 0; $i < $amount_of_users; ++$i)
        {
            $name = $prefix.$i;
            $users[$name] = new \distributor\User($name);
        }

        return $users;
    }

    /**
     * Generates chosen groups for users
     *
     * @param $users Array of users
     * @param $groups Array of groups
     */
    public static function generate_chosen_groups(&$users, &$groups)
    {
        foreach($users as &$user)
        {
            $amount = mt_rand(1, count($groups));

            if($amount > 1)
                foreach(array_rand($groups, $amount) as $key)
                    $user->add_chosen_group($groups[$key]);
            else
                $user->add_chosen_group($groups[array_rand($groups, $amount)]);
        }
    }

    /**
     * Generates test data

     * @return An array with length of 2 consisting of an array of users and an array of groups
     */
    public static function generate_test_data($amount_of_users, $max_groups, $user_prefix = 'u', $group_prefix = 'g')
    {
        $groups = Generator::generate_random_groups($max_groups, $amount_of_users, $group_prefix);
        $users = Generator::generate_users($amount_of_users, $user_prefix);
        
        Generator::generate_chosen_groups($users, $groups);

        return ['users' => &$users, 'groups' => &$groups];
    }
}