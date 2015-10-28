 $(function() {
    var availableTags = [
        "Barbara",
        "Cabernet Franc",
        "Cabernet Sauvignon",
        "Gamay",
        "Grenache",
        "Malbec",
        "Merlot",
        "Mourvèdre",
        "Nebbiolo",
        "Petite Sirah",
        "Pinot Noir",
        "Sangiovese",
        "Syrah",
        "Shiraz",
        "Tempranillo",
        "Zinfandel",
        "Chardonnay",
        "Chenin blanc",
        "Gewürztraminer",
        "Grüner Veltliner",
        "Muscat",
        "Pinot Grigio",
        "Riesling",
        "Sauvignon Blanc",
        "Viognier"
    ];
    $( "#varietals" ).autocomplete({
      source: availableTags
    });
  });
    
