<?php


namespace App\Http\Filter;


use App\Http\Filter\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractFilter implements FilterInterface
{
    /** @var array */
    protected $queryParams = [];

    /**
     * AbstractFilter constructor.
     *
     * @param array $queryParams
     */
    public function __construct(array $queryParams)
    {
        $this->queryParams = $queryParams;
    }

    abstract protected function getCallbacks(): array;

    public function apply(Builder $builder)
    {
        $this->before($builder);


        foreach ($this->getCallbacks() as $name => $callback) {
            if (isset($this->queryParams[$name])) {
                call_user_func($callback, $builder, $this->queryParams[$name]);
            }
        }
    }

    protected function getQueryParam($key)
    {
        return $this->queryParams[$key];
    }

    /**
     * @param Builder $builder
     */
    protected function before(Builder $builder)
    {
    }
}
