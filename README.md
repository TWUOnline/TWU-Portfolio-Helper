# TWU-Portfolio-Helper

* a [cog.dog](https://cog.dog) production

Creates custom post types and taxonomies for Trinity Western University portfolios.

## Shortcodes

The plugin enables use of these shortcodes which can be used in posts, pages, and widgets


### Artifact Count

    [artifact_count]
    
Displays a current total count of all artifacts in the portfolio, it will produce output if a portfolio contains say 12 artifacts, like:

    12 artifacts
    
Adding a parameter `link=1` it will output the same but as a hyperlink to view all the artifacts.

    [artifact_count link=1]
    

### Artifact types

This shortcode will output a full index of the portfolio structure according to the taxonomy for Artifacts (which can be edited in the WordPress dashboard under **TWU Portfolio** -> **Artifact Types**.

    [artifact_types]
    
Will list the full taxonomy, each linked to its archive, with a display of how many artifacts are within that type. The following parameters can be used in the shortcode

* `show_description=1` Show the description of the artifact type (if available). Default is `1` to show, set to `0` to hide.
* `show_children=1` Display one level of sub-types. Default is `1` to show, set to `0` to hide.
* `hide_empty=0` Only list types that are used in artifacts. Default is `0` to show all available, set to `1` to show only ones that are used.
* `order_by='id'` How the types are sorter; `id` (default) is by order they ere created; other options include `name` to sort by title, `count` by count of items.
* `order` direction of sorting; `ASC` (default) is alphabetical or increasing; used `DESC` for reverse

Example- List full taxonomy without descriptions

    [artifact_types show_description=0]
    

Example- List only top level taxonomy without descriptions (e.g for a widget).

    [artifact_types show_description=0 show_children=0]
