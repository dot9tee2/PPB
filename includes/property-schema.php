<?php
function generatePropertySchema($property) {
    $schema = array(
        "@context" => "https://schema.org",
        "@type" => "RealEstateListing",
        "name" => $property['title'],
        "description" => $property['description'],
        "image" => $property['images'][0] ?? '',
        "price" => $property['price'],
        "priceCurrency" => "PKR",
        "address" => array(
            "@type" => "PostalAddress",
            "addressLocality" => $property['city'],
            "addressRegion" => $property['region'],
            "addressCountry" => "PK"
        ),
        "datePosted" => $property['date_posted'],
        "propertyType" => $property['property_type'],
        "floorSize" => array(
            "@type" => "QuantitativeValue",
            "value" => $property['area'],
            "unitText" => $property['area_unit']
        )
    );

    if (!empty($property['amenities'])) {
        $schema['amenityFeature'] = array_map(function($amenity) {
            return array(
                "@type" => "LocationFeatureSpecification",
                "name" => $amenity
            );
        }, $property['amenities']);
    }

    return json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
?> 