<?php

namespace App\Filters;

use Illuminate\Http\Request;
use Closure;

/**
 * Class Filter
 * Handles a chain of responsibility pattern for processing filters on a request.
 */
class Filter
{
    /** 
     * @var Filter[] Array of filter instances. 
     */
    protected $filters = [];

    
    /** 
     * @var Filter|null The next filter in the chain. 
     */
    protected $nextFilter = null;


    /**
     * Constructor.
     */
    public function __construct()
    {
    }


    /**
     * Adds a single filter to the chain.
     * 
     * @param class-string $filterClass The class name of the filter to add.
     * @return $this
     * @throws \Exception If the class does not exist.
     */
    public function addFilter(string $filterClass): self
    {
        if (class_exists($filterClass)) {
            $this->filters[] = new $filterClass();
        } else {
            throw new \Exception("Class $filterClass does not exist.");
        }

        return $this;
    }


    /**
     * Adds multiple filters to the chain.
     * 
     * @param array<class-string> $filters Array of class names to add.
     * @return $this
     */
    public function addFilters(array $filters): self
    {
        foreach ($filters as $filter) {
            $this->addFilter($filter);
        }

        return $this;
    }


    /**
     * Applies the filter chain to the given request.
     * 
     * @param Request $request The request to process.
     * @return mixed
     */
    public function apply(Request $request)
    {      
        for ($i = 0; $i < count($this->filters) - 1; $i++) {
            $this->filters[$i]->setNext($this->filters[$i + 1]);
        }
        
        return $this->filters[0]->handler($request, function ($request) {
            return $this->filters[0]->next($request);
        });
    }


    /**
     * Processes the current filter.
     * 
     * @param Request $request The request to process.
     * @param Closure $next The next callback in the chain.
     * @return mixed
     */
    protected function handler(Request $request, Closure $next)
    {
        return $next($request);
    }


    /**
     * Calls the next filter in the chain.
     * 
     * @param Request $request The request to process.
     * @return mixed
     */
    protected function next(Request $request)
    {
        if ($this->nextFilter) {
            return $this->nextFilter->handler($request, function ($request) {
                return $this->nextFilter->next($request);
            });
        }

        return $request;
    }

    
    /**
     * Sets the next filter in the chain.
     * 
     * @param Filter $filter The next filter instance.
     * @return void
     */
    protected function setNext(Filter $filter): void
    {
        $this->nextFilter = $filter;
    }
}
