<option value="all">All</option>
    @foreach($countries as $country)
        <option value="{{ $country->country_id }}">{{ $country->country_name }}</option>
    @endforeach


