<?php
namespace distributor;

class Group
{
	private $id = '';
	private $limit = 0;
	private $assigned_users = [];

    /**
     * Creates a new group
     *
     * @param $id Id of the group
     * @param $limit Group limit
     */
	public function __construct($id, $limit = 0)
	{
		$this->id = $id;
        $this->set_limit($limit);
	}

    /**
     * Returns the group id
     *
     * @return Id of the group
     */
	public function get_id()
	{
		return $this->id;
	}
	
    /**
     * Checks if the group has a limit (limit is zero)
     *
     * @return True if the group has a limit
     */
    public function has_limit()
    {
        return $this->limit != 0;
    }

    /**
     * Returns the group limit
     *
     * @return Group limit
     */

	public function get_limit()
	{
		return $this->limit;
	}

    /**
     * Checks if the group is empty
     *
     * @return True if the group is empty
     */
    public function is_empty()
    {
        return empty($this->assigned_users);
    }

    /**
     * Checks if the group is full (limit has been reached)
     *
     * @return True if the group is full
     */
    public function is_full()
    {
        if($this->limit == 0)
            return false;

        return count($this->assigned_users) == $this->limit;
    }

    /**
     * Sets the group limit (zero for no limit)
     *
     * @param $limit The new group limit
     * @throws Exception if the group limit is negative
     */
    public function set_limit($limit)
    {
        if($limit < 0)
            throw new Exception('Limit cannot be negative!');

        $this->limit = $limit;
    }
	
    /**
     * Returns an array of users which are assigned to the group
     *
     * @return Array of users which are assigned to the group
     */
	public function get_assigned_users()
	{
		return $this->assigned_users;
	}

	/**
	 * Adds an assigned user to the group
	 * 
	 * @param $user User that gets added to the group
     *
     * @throws Exception if the group limit has been reached or the user has been already assigned a group  
	 */
	public function add_assigned_user(& $user)
	{
        if($this->is_full())
            throw new \Exception('Limit has been reached!');

        if($this->exists_assigned_user($user) || $user->get_assigned_group() == $this)
            throw new \Exception('User has been already assigned to this group!');

        if($user->get_assigned_group() != null)
            throw new \Exception('User has been already assigned to another group!');

        $this->assigned_users[$user->get_id()] = & $user;
	}

    /**
     * Checks if user belongs to this group
     *
     * @param $user User that gets checked
     *
     * @return True if user belongs to this group
     */
    public function exists_assigned_user($user)
    {
        return isset($this->assigned_users[$user->get_id()]);
    }
	
	/**
	 * Removes a user from the group
	 * 
	 * @param $user User that gets removed from the group
     *
	 * @throws Exception If user was not assigned from the group
	 */
	public function remove_assigned_user($user)
	{
        if(!$this->exists_assigned_user($user))
            throw new \Exception('User has not been assigned to this group!');
		
        unset($this->assigned_users[$user->get_id()]);
	}
}