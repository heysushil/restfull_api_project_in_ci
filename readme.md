# RestFul Api Codeigniter based project

1. In this project created rest ful api and used data from that to shwo on html page.
1. Also used ajax and jquery to get all type of data and activies like add/edit/show/delete using without page load.

## Codeigniter based Robot and Survivours coding flow:

1. Project have 2 controllers:
    1. welcome: default controller sued to pass all releated data to html page.
    1. survivour_api: its use to created a multipal methods for multipal works which you explore when you setup this on your local system and run.
1. One view file:
    1. survivour: single html page used and compled all the task like:
        1. show all survivours list:
            1. used popup modal, actully for all use case I used popuup modals and used them very well in this project.
            1. in this list also have 3 functionalitys:
                1. add new survivour: form on click to open popup modal, after submiting the form modal you will get success or error message and again came back to list modal. I love this part to come back to privious modal and close current modal. for that I learned many jquery events.
                1. update location: update survivours current location by clicking on location button. in this case open on form up side where you can fill the details and after submit you get success or error message.
                1. flag: in case survivour get infected you made survivour as infected or safe by clicking the button.
                1. delete: click to delete the survivor and on time refresh the modal without pageload. for this also I explored many things but I love this part also.
        1. show all inventory list:
            1. you can see the list of inverty stock to each survivour and for that I used bs progress bar. its dynamic you can change values on database or add the feature in this project to update inventroy. it's you choice.
        1. show repots:
            1. list of infected: on click open a list of all infected surviours on another modal. when you wanat to came back to report you clcik to back and open report modal. I love this part and it remind me youtube studio modal work. which is i think i explored here.
            1. list of non infected: it's also same aas the list of infected but data changed here.
            1. below side you show diffente data as per requirments

            