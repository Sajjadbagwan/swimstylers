<?php

namespace Swim\Core\Http\Controllers;

use Swim\Core\Repositories\CountryRepository;
use Swim\Core\Repositories\CountryStateRepository;

/**
 * Country controller
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CountryStateController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CountryRepository object
     *
     * @var array
     */
    protected $countryRepository;

    /**
     * CountryStateRepository object
     *
     * @var array
     */
    protected $countryStateRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Swim\Core\Repositories\CountryRepository      $countryRepository
     * @param  \Swim\Core\Repositories\CountryStateRepository $countryStateRepository
     * @return void
     */
    public function __construct(
        CountryRepository $countryRepository,
        CountryStateRepository $countryStateRepository
    )
    {
        $this->countryRepository = $countryRepository;

        $this->countryStateRepository = $countryStateRepository;

        $this->_config = request('_config');
    }

    /**
     * Function to retrieve states with respect to countries with codes and names for both of the countries and states.
     *
     * @return \Illuminate\View\View
     */
    public function getCountries()
    {
        $countries = $this->countryRepository->all();

        $states = $this->countryStateRepository->all();

        $nestedArray = [];

        foreach ($countries as $keyCountry => $country) {
            foreach ($states as $keyState => $state) {
                if ($country->code == $state->country_code) {
                    $nestedArray[$country->name][$state->code] = $state->default_name;
                }
            }
        }

        return view($this->_config['view'])->with('statesCountries', $nestedArray);
    }

    public function getStates($country)
    {
        $countries = $this->countryRepository->all();
        
        $states = $this->countryStateRepository->all();

        $nestedArray = [];

        foreach ($countries as $keyCountry => $country) {
            foreach ($states as $keyState => $state) {
                if ($country->code == $state->country_code) {
                    $nestedArray[$country->name][$state->code] = $state->default_name;
                }
            }
        }

        return view($this->_config['view'])->with('statesCountries', $nestedArray);
    }
}