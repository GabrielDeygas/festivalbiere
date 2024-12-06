<?php

namespace App\Filament\Pages;

use App\Repositories\BeerRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\StatsRepository;
use App\Repositories\UserRepository;
use Filament\Pages\Page;

class Stats extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.stats';
    protected BeerRepository $beerRepo;
    protected ReviewRepository $reviewRepo;
    protected UserRepository $userRepo;
    public $data;

    public function mount()
    {
        $this->beerRepo = new BeerRepository();
        $this->reviewRepo = new ReviewRepository();
        $this->userRepo = new UserRepository();

        $this->data = [
            'totalBeers' => $this->beerRepo->getTotalBeers(),
            'totalReviews' => $this->reviewRepo->getTotalReviews(),
            'averageRating' => $this->reviewRepo->getAverageRating(),
            'totalUsers' => $this->userRepo->getTotalUsers(),
            'mostRatedBeers' => $this->beerRepo->getTop5MostRatedBeers(),
            'topRatedBeers' => $this->beerRepo->getTop5RatedBeers(),
        ];
    }
}

