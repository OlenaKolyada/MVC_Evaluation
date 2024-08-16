document.addEventListener('DOMContentLoaded', function() {
    const selectElement = document.getElementById('genre');
    const form = document.getElementById('search_form');

    selectElement.addEventListener('change', function() {
        const genreSelect = this.value;

        if (genreSelect === "") {
            form.action = "?c=MovieController&m=getAllMovies";
        } else {
            form.action = "?c=MovieController&m=getMoviesByGenre";
        }
    });

    if (selectElement.selectedIndex === 0) {
        form.action = "?c=MovieController&m=getAllMovies";
    }
});