<?php
namespace distributor;

require_once('linear_program.php');

class LPFileWriter
{
    public static function write_objective_method($objective_method)
    {
        if($objective_method == LinearProgram::MINIMIZE)
            return 'Minimize';
        elseif($objective_method == LinearProgram::MAXIMIZE)
            return 'Maximize';

        throw new \exception('Linear program objectives method is invalid!');
    }
    
    public static function write_objective($linear_program)
    {
        if(empty($linear_program->get_objective_function()))
            throw new \exception('Linear program objectives function is invalid!');

        return self::write_objective_method($linear_program->get_objective_method())."\n  ".str_replace('*', ' ', $linear_program->get_objective_function())."\n";
    }
    
    public static function write_constraints($linear_program)
    {
        if(empty($linear_program->get_constraints()))
            return '';
        
        return "Subject To\n".implode(array_map(
            function($constraint)
            {
                return "  $constraint\n";
            }, $linear_program->get_constraints()));        
    }

    public static function write_bounds($linear_program)
    {
        if(empty($linear_program->get_bounds()))
            return '';
        
        return "Bounds\n".implode(array_map(
            function($bound)
            {
                return "  $bound\n";
            }, $linear_program->get_bounds()));
    }
    
    public static function write_variables($linear_program)
    {
        if(empty($linear_program->get_variables()))
            return '';

        return "General\n  ".implode(array_map(
            function($variable)
            {
                return $variable['name'].' ';
            }, $linear_program->get_variables()))."\n";
    }
    
    public static function write($linear_program)
    {
        return self::write_objective($linear_program)
            .self::write_constraints($linear_program)
            .self::write_bounds($linear_program)
            .self::write_variables($linear_program).'End';
    }
};