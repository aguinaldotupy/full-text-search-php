<?php

namespace Tupy\Search\Traits;

/**
 * Trait FullTextSearch
 * @package Tupy\Search\Traits
 * @mixin static \Illuminate\Database\Eloquent\Builder fullTextSearch($term)
 */
trait SearchTrait
{
	//In progress

    private $searchable = [];
    /**
     * Replaces spaces with full text search wildcards
     *
     * @param string $term
     * @return string
     */
    protected function fullTextWildcards($term)
    {
        // removing symbols used by MySQL
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);

        $words = explode(' ', $term);

        foreach($words as $key => $word) {
            /*
             * applying + operator (required word) only big words
             * because smaller ones are not indexed by mysql
             */
            if(strlen($word) >= 3) {
                $words[$key] = '+' . $word . '*';
            }
        }

        return implode(' ', $words);
    }

    /**
     * Scope a query that matches a full text search of term.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFullTextSearch($query, $term)
    {
    	//In progress return score search
        // dd($term);
        // $columns = implode(',',$this->searchable);

        // $searchableTerm = $this->fullTextWildcards($term);
        // dd($searchableTerm);

        // return $query->selectRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE) AS relevance_score", [$searchableTerm])
        // ->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $searchableTerm)
        // ->orderByDesc('relevance_score');


        $columns = implode(',',$this->searchable);

        return $query->where(function (Builder $queryFullText) use ($columns, $term) {
            $queryFullText->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($term));
        });
    }
}
