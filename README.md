# CM-Bootstrap
Work for the CM Bootstrap theme and companion modules

This documentation is a work in progress.

Download the “modules” and the “themes” folders. From the module folder, drag everything inside to your sites/all/modules folder. From the theme folder, drag everything inside to your sites/all/themes folder. Upload to your site. Then follow the steps below. 

1.)  Modules

1a.) Contrib Modules (download from drupal.org project pages)
enable these modules:

admin_menu

bundle_copy

color_field

devel

menu_attributes

menu_block

module_filter

node_clone

rabbit_hole

flag

blog

hms field

1b.) Custom Modules
enable these modules (most of these should be under the “CM Bootstrap” group):

custom_block

custom_form

custom_front_pg_slider

custom_video_lists

media_cloudcast_feed_fix (if using media cloudcast)

site_cp

site_wrapper

community_features (this is not ready yet to be used, do not enable yet at this time)

media cloudcast chapters field & media cloudcast chapters (if using - download from their drupal pages)

1c.) Run the media cloudcast chapter importer if applicable so you have some chapters to see (this is not set up for cm agenda yet, or youtube chapters -- youtube chapters is covered in development but cm agenda addition is not yet covered).

You will then need to create a few imagecache image styles (this will soon be added to the modules): 
one that is called ‘front_pg_slider_1440_x_720’ and set to Scale and crop 1440x720

one called ‘250x150’ that is scale and crop 250x150

one called ‘500x281’ set to scale and crop.

Then an optional step that you may need to run later if you are seeing broken thumbnails (after you start enabling blocks), you will then need to fix legacy cloudcast images if you use cloudcast images. This only will need to happen once and you should only do it as an administrator user/1. Go to /cp/cloudcast-legacy and type “GENERATE” in the box. This may take a long time to run depending on how many cloudcast shows you have, be patient and do not leave the page. When it finishes you will see loads of errors, but don’t worry, be happy. Just ignore them. You may not have to run this, but if you are seeing broken thumbnails after you start enabling blocks, you might need to run it. 

1d.) Sync up your content types. You will need bundle copy for this. pretty sure bundle copy only adds new fields - won’t delete existing fields, but hasn’t been double checked. There may be some issues you’ll need to adjust if your fields are not named the same thing as the fields this theme is built for. This is a big chunk of development that will need funding if there are to be generic fields. The included file called “bundles.txt” gives you the following content types (or adds to your existing ones):

archive (content type)

archive (node reference)

blog

cm_project (with additional fields used in theme)

cm_show (with additional fields used in theme)

color scheme

custom video list

genre

basic page

partner

slider

video grid

Important note: for the content types you already have, you might just want to look through bundles.txt for the fields you need. A lot of them are not necessary for the theme. Mainly just the media field and description field on cm_show, and then the image field and description on cm_project. If you are having trouble with that import, you can try to just import the “bundles-minimal.txt” which does not include the show and project content type. 

1e. Let’s add some custom video lists and some video grids so we have content to work with. A custom video list is just a custom “carousel” of videos of your choosing that you can then add to any page / show / project on your site. There are also automatic custom video lists (things like “shows in this series” that automatically display on a show page and a series page), but you can also add your own custom video lists that are collections of any videos you want. Custom video lists display horizontally. 

Go to node/add/custom-video-list

Give this custom video list a title “Best Videos Ever”

Give it a description “Clearly the best videos on Earth!”

Now in the “show/series to highlight” field you just start auto referencing either shows or series (projects). Note that you only want to include series/projects IF you have uploaded an image to represent your project to the “series image” field that was added in step 1d. This just makes it so you could link to a series page from a series thumbnail in a custom video list. If you don’t want to do this, don’t! Just add shows to your custom video list because those have automatic thumbnails. 

Now let’s add a video grid. Video grids are like custom video lists, but they display in a grid. You must create at least 3 video grid pieces of content before you can use the video grid. 

Go to node/add/video-grid

Give what will be one column of a video grid a title “Staff favorites” and heading “All of our best picks”

Associate three shows with this grid (you can only do 3 shows in each column)

Repeat these steps two more times (create at least two more of these)

1f. Now let’s create the homepage of your site. 

Create front pg node (basic pg).

You don’t need to put anything in the description/body field.

On the “custom video list” field, select the custom video list you just made. 

On the “video grids” field, select THREE (you MUST always select three grids, only three grids, and never more than three grids because technically these are columns that make up the full grid)

Set default front pg to this node: admin/config/system/site-information

1g. If you are going to want a large slider on your homepage, you’ll also need to add some sliders.

go to node/add/slider

fill out the title, image, slider reference fields.

2.) Themes
enable these themes:

2a.) Contrib Themes

bootstrap (enable)

2b.) Custom Themes

CM Bootstap (enable and set as default)

2c.) Themes Configuration

base theme: bootstrap

default theme: CM Bootstrap

3. Time to enable blocks. Go to admin/structure/block and enable the following with the settings included:

3a.) Configure 'custom_front_pg_slider: Front Pg Jumbotron' BLOCK.

region: Above Content

visibility: <front>

3b.) Configure custom_block: Video Grid

region: Below content

visibility: no restrictions

3c.) Front Pg Latest Shows Carousel

Configure 'Front Pg Latest Shows Carousel' BLOCK. This will display the most recently added shows on your homepage. 

region: below Content

visibility: <front>

3d.) custom_block: cb_custom_video_lists_front

Configure 'cb_custom_video_lists_front' BLOCK.

region: Below Content

visibility: <front>

3e.) Partners

custom_block: Partners Carousel

region: below content

visibility: partners

You will need to create a basic page and title it “Partners”. You will then also need to use the partner content type. The partner content type is used at RETN in order to allow an organization to be associated with a bunch of series. So for instance, maybe the “Town of Hinesburg” is a partner. And they are associated with the series “Hinesburg Select Board” and “Hinesburg School Board” and “Arts Walk”. To do this, you first create the partner node/add/partner and fill out the fields. Then you can associate this partner with an entire series/project OR you can associate it with a one-off show. Go to a series or show and look for the field called “partner” and associate that partner. 

3f.) Genres

custom_block: Genres Carousel

region: content

visibility: genres

You will need to create a basic page and title it “Genres”. You will then also need to use the genre content type. This is a way to use topics or genres and have shows display in carousels for that genre/topic. Add a genre node/add/genre called “Arts & Performance”. Now go to a bunch of shows and look for the genres field and associate them with the Arts & Performance genre. You will see things start to autopopulate in the genre video carousels and on your genre page. 

3g.) block_shows_in_series_genres

region: Below Content

visibility: “genre” content type

3h.) custom_video_lists: Block "Show" TPL Series Carousel

region: Below Content

visibility: show/*

3i.) custom_block: Partner Detail Pg -- Partners Carousel [Show + Series]

region: Below Content

visibility: partner content type

3j.) custom_block: Partner Detail Pg -- All Series Carousel
region: Below Content
visibility: partner content type

3k.) custom_block: cb_custom_video_lists

region: Below Content

visibility: up to you (this displays custom video lists)

3l.) custom_block: Genres Show Series Carousel

region: Below Content

visibility: genre content type

3m.) custom_video_lists: Block Series Carousel

region: Below Content

visibility: cm_project content type

3n.) custom_block: Show Node Meta Data

region: Below Content (Fixed Width)

visibility: cm_show content type

3o.) custom_block: Show Right Sidebar

region: Secondary

visibility: cm_show content type


4.) Site wide STUFF

4a.) Create Navigation Menu

4aa.) Create Menu (limit this to 3 items because otherwise it will go to double lines on mobile...the purpose of a slide out menu is to use the slide out area for you main items! just put a key item like “donate” in this menu to show up at all times)

4ab.) Create Menu Block for Menu

4ac.) Put in 'Navigation' Region

4b.) jPanel

4ba.) Create menu block for jPanel Region.

4bb.) Put menu block in jPanel region.

4bc.) Put search form block in jPanel region.

4c.) Logo

4ca.) Configure block 'Site Logo [Site Wrapper]'.

4cb.) Put block in 'Below Navigation' region.

4d.) Footer

4da.) Create menus for footer (you MUST have parent item as top level and then indent child items and make sure “show as expanded” is checked on the parent item, otherwise your child items won’t show up)

4db.) Create menu blocks for footer.

4dc.) Put menu blocks in “footer” region.

4e.) Social media icons

custom_block: Social Media Menu

put in “below footer” region

You can edit this menu to change the links

5.) Colors

requires custom modules: custom_form and site_cp

configure colors (cp/colors) (and give permission to access this on permissions page)
