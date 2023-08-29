<section id="el-filter-article" class="el-center-box">
    <div class="el-content-area">
        <h2>filtrer</h2>
        <div class="el-grid-filter-article">
            <form>
                <div class="el-ligne">
                    <div class="el-col">
                        <label for="color_id">couleur</label>
                        <select class="el-filter-select" name="color_id[]" id="color_id" multiple>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="el-col">
                        <label for="material_id">matière</label>
                        <select class="el-filter-select" name="material_id[]" id="material_id" multiple>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(isset($availabilities))
                        <div class="el-col">
                            <label for="availability_id">Disponibilité</label>
                            <select class="el-filter-select" name="availability_id[]" id="availability_id" multiple>
                                @foreach($availabilities as $availability)
                                    <option value="{{ $availability->id }}">{{ $availability->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
            </form>
            <!-- <p class="result-count">Affichage de 1–32 sur 112 résultats</p> -->
        </div>
    </div>
</section>
