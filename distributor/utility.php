<?php
namespace distributor;

class Utility
{
    /**
     * Returns the intersection of two arrays of groups
     * 
     * @param $groups1 Array of groups
     * @param $groups2 Array of groups
     *
     * @return Intersection of groups1 and groups2
     */
    public static function get_group_intersection($groups1, $groups2)
    {
        $get_ids = function($group)
        {
            return $group->get_id();
        };

        $intersection_ids = array_intersect(array_map($get_ids, $groups1), array_map($get_ids, $groups2));
        
        return array_filter($groups1, function($group) use($intersection_ids)
        {
            return array_key_exists($group->get_id(), $intersection_ids);
        });
   }
};
?>