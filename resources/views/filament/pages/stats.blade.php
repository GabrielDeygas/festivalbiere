<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<x-filament::page>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700">Nombre de bières</h2>
            <p class="text-3xl font-bold text-gray-700">{{ $data['totalBeers'] }}</p>
        </div>

        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700">Nombre d'avis</h2>
            <p class="text-3xl font-bold text-gray-700">{{ $data['totalReviews'] }}</p>
        </div>

        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700">Note moyenne</h2>
            <p class="text-3xl font-bold text-gray-700">{{ round($data['averageRating'], 2) ?? 'N/A' }}</p>
        </div>

        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700">Total utilisateurs</h2>
            <p class="text-3xl font-bold text-gray-700">{{ $data['totalUsers'] }}</p>
        </div>

        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Top 5 Most Rated Beers</h2>
            <ul class="space-y-2">
                @foreach ($data['mostRatedBeers'] as $beer)
                    <li class="text-gray-600">
                        <a href="{{ route('beer.show', $beer->id) }}" class="text-blue-500 hover:underline">
                            <strong>{{ $beer->name }}</strong> - {{ $beer->reviews_count }} reviews
                        </a>

                    </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Top 5 Best Rated Beers</h2>
            <ul class="space-y-2">
                @foreach ($data['topRatedBeers'] as $beer)
                    <li class="text-gray-600">
                        <a href="{{ route('beer.show', $beer->id) }}" class="text-blue-500 hover:underline">
                            <strong>{{ $beer->name }}</strong> - Average Rating:
                            {{ round($beer->reviews_avg_note, 2) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>


        <div class="bg-white p-4 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-gray-700">Statistiques des Bières</h2>
            <canvas id="beerChart" class="mt-4"></canvas>
        </div>

        <div class="bg-white p-4 rounded-lg shadow mt-6">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Répartition des Types de Bières</h2>
            <canvas id="beerTypeChart" class="mt-4"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const totalBeersUrl = '{{ url('/api/stats/total-beers') }}';
            const totalReviewsUrl = '{{ url('/api/stats/total-reviews') }}';
            const beerTypesUrl = '{{ url('/api/stats/beer-types') }}';

            Promise.all([
                    fetch(totalBeersUrl).then(response => response.json()),
                    fetch(totalReviewsUrl).then(response => response.json()),
                    fetch(beerTypesUrl).then(response => response.json())
                ])
                .then(([totalBeers, totalReviews, beerTypes]) => {
                    const ctxBar = document.getElementById('beerChart').getContext('2d');
                    new Chart(ctxBar, {
                        type: 'bar',
                        data: {
                            labels: ['Nombre de Bières', 'Nombre d’Avis'],
                            datasets: [{
                                label: 'Statistiques',
                                data: [
                                    totalBeers.total_beers,
                                    totalReviews.total_reviews
                                ],
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 99, 132, 0.5)'
                                ],
                                borderColor: [
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 99, 132, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    const ctxPie = document.getElementById('beerTypeChart').getContext('2d');
                    const labels = beerTypes.map(type => type.type);
                    const data = beerTypes.map(type => type.count);
                    new Chart(ctxPie, {
                        type: 'pie',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Répartition des Types de Bières',
                                data: data,
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 206, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(255, 159, 64, 0.5)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Erreur lors de la récupération des données :', error));
        });
    </script>

</x-filament::page>
