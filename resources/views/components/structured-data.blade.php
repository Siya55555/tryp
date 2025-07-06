@props(['type' => 'Organization', 'data' => []])

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "{{ $type }}",
    @foreach($data as $key => $value)
        "{{ $key }}": @json($value)@if(!$loop->last),@endif
    @endforeach
}
</script>
