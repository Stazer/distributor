<?php
namespace distributor;

class LinearProgram
{
    const NONE = -1;
    const MINIMIZE = 0;
    const MAXIMIZE = 1;

    const BINARY = 0;
    const INTEGER = 1;
    const REAL = 2;
    const COMPLEX = 3;
    
    private $objective_method = self::NONE;
    private $objective_function = '';

    private $constraints = [];

    private $bounds = [];
    
    private $variables = [];

    
    public function set_objective_method($objective_method)
    {
        $this->objective_method = $objective_method;
    }

    public function get_objective_method()
    {
        return $this->objective_method;
    }

    public function set_objective_function($objective_function)
    {
        $this->objective_function = $objective_function;
    }
    
    public function get_objective_function()
    {
        return $this->objective_function;
    }

    public function set_objective($objective_method, $objective_function)
    {
        $this->set_objective_method($objective_method);
        $this->set_objective_function($objective_function);
    }

    public function set_constraints($constraints)
    {
        $this->constraints = $constraints; 
    }

    public function get_constraints()
    {
        return $this->constraints;
    }
    
    public function add_constraint($constraint)
    {
        $this->constraints[] = $constraint;
    }

    public function set_bounds($bounds)
    {
        $this->bounds = $bounds; 
    }

    public function get_bounds()
    {
        return $this->bounds;
    }
    
    public function add_bound($bound)
    {
        $this->bounds[] = $bound;
    }

    public function set_variables($variables)
    {
        $this->variables = $variables;
    }
   
    public function get_variables()
    {
        return $this->variables;
    }
    
    public function add_variable($variable, $type = self::REAL)
    {
        $this->variables[$variable] = ['type' => $type, 'name' => $variable];
    }
};

?>