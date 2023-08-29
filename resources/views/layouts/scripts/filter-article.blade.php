
<script>
    // Fonction pour mettre à jour les articles en fonction des filtres sélectionnés
    function updateFilteredArticles() {
        const selectedSubcategoryId = $('.el-filter-select').data('subcategory-id');
        const selectedColors = $('#color_id').val();
        const selectedMaterials = $('#material_id').val();
        const selectedAvailabilities = $('#availability_id').val();

        $.ajax({
            url: "{{ route('filter.articles') }}",
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                subcategory_id: selectedSubcategoryId,
                color_ids: selectedColors,
                material_ids: selectedMaterials,
                availability_ids: selectedAvailabilities,
                @if(isset($category))
                category_id: {{ $category->id }},
                @elseif(isset($subcategory))
                subcategory_id: {{ $subcategory->id }}
                @else
                statut: @if($title === 'Nouvel arrivage') 1 @elseif($title === 'Déstockage') 5 @endif
                @endif
            },
            success: function(response) {
                $('.el-grid-articles').html(response);
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error(errorThrown);
            }
        });
    }

    // Écouter les événements de changement de valeur sur les <select> de filtre
    $('.el-filter-select').on('change', function() {
        updateFilteredArticles();
    });
</script>