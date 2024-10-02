

(function ($) {
    'use strict';
   
    Object.defineProperty(Array.prototype, 'chunk_inefficient', {
        value: function (chunkSize) {
            var array = this;
            return [].concat.apply([],
                array.map(function (elem, i) {
                    return i % chunkSize ? [] : [array.slice(i, i + chunkSize)];
                })
            );
        }
    });
    
    var $wdb_page_import = {
    
        init: function( settings ) {
            $wdb_page_import.config = {
                items    : $( "#myFeature li" ),
                container: $( "<div class='container'></div>" ),
                pages    : [],
                current_page: 0,
                per_page: 20,
                search_content: [],
                filter_active: 0,
               
            };     
            // Allow overriding the default config
            $.extend( $wdb_page_import.config, settings );     
            $wdb_page_import.setup();            
        },
     
        setup: function() {  
            $wdb_page_import.setup_initial_templates();
            jQuery("#wdb-page-importeri").on("wdb:pagemodel:open", function(event) {
               $wdb_page_import.mesonary_build();
            });
            jQuery(document).on('click', '.wdb-return-to-libary' ,function(){
              jQuery('.wdb-templates-list-renderer').show();
              jQuery('.wdb-templates-list-renderer').siblings().hide();
              $wdb_page_import.mesonary_build();
            });
            jQuery(document).on('click', '.wdb--general-tpls-button',$wdb_page_import.import_page);
            jQuery(document).on('keyup', '.wdb-page-search-js', function(){
                jQuery('.wdb-templates-list-renderer .body-import-active-overlay').remove();
                jQuery('.wdb-templates-list-renderer').show();
                jQuery('.wdb-templates-list-renderer').siblings().hide();
                $wdb_page_import.config.current_page = 0;
                let search_key = $(this).val();                
                if( search_key.length > 2 ){
                    $wdb_page_import.config.filter_active = 1;
                    $wdb_page_import.filter_content(search_key);
                    $wdb_page_import.mesonary_build();
                }else{
                    $wdb_page_import.config.filter_active = 0;
                    $wdb_page_import.mesonary_build();
                }
               
                jQuery('.wdb-page-select-type option[value="0"]').attr("selected",true);
            });
            
            jQuery(document).on('change' , '.wdb-page-select-type',$wdb_page_import.filter_category);            
            jQuery(document).on('click' , '.wdb-templates-pagination .prev', $wdb_page_import.prev_page_template);
            jQuery(document).on('click' , '.wdb-templates-pagination .next', $wdb_page_import.next_page_template);
        },
        
        import_page: function(e){
            e.preventDefault();
            let id         = jQuery(this).attr('data-id');
            let page_title = jQuery(this).text();
            var data = {
                action    : 'wdb_page_xml_file_import',
                nonce     : wdb_import_obj.ajax_nonce,
                id        : id,
                page_title: page_title,
                step      : 'download'
            };
            
            $wdb_page_import.run_importer_process(data);          
            jQuery('.wdb-dpage-xml-import-container > .wdb-msg').html('');
            jQuery('.wdb-templates-list-renderer').siblings().show();
            $('.wdb-templates-list-renderer').html(`<div class='body-import-active-overlay'><svg width="200px" height="200px"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" style="background: none;">
			<circle cx="75" cy="50" fill="#363a3c" r="6.39718">
				<animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.875s"></animate>
			</circle>
			<circle cx="67.678" cy="67.678" fill="#363a3c" r="4.8">
				<animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.75s"></animate>
			</circle>
			<circle cx="50" cy="75" fill="#363a3c" r="4.8">
				<animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.625s"></animate>
			</circle>
			<circle cx="32.322" cy="67.678" fill="#363a3c" r="4.8">
				<animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.5s"></animate>
			</circle>
			<circle cx="25" cy="50" fill="#363a3c" r="4.8">
				<animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.375s"></animate>
			</circle>
			<circle cx="32.322" cy="32.322" fill="#363a3c" r="4.80282">
				<animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.25s"></animate>
			</circle>
			<circle cx="50" cy="25" fill="#363a3c" r="6.40282">
				<animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="-0.125s"></animate>
			</circle>
			<circle cx="67.678" cy="32.322" fill="#363a3c" r="7.99718">
				<animate attributeName="r" values="4.8;4.8;8;4.8;4.8" times="0;0.1;0.2;0.3;1" dur="1s" repeatCount="indefinite" begin="0s"></animate>
			</circle>
		</svg></div>`);
        },
        setup_loop_template: function (single) {
            return `			
			<div class="wc-pageimg-wrapper">
				<img data-src="${single.thumbnail}" src="${single.thumbnail}"/>
			</div>
			<div class="action-wrapper">				
				<button class="er-template-import wdb--general-tpls-button" data-id="${single.id}" data-title="${single.title}">
					Import
				</button>	
				<a target="_blank" class="demo-url" href="${single.url}" data-title="${single.title}">
					Preview
				</a>	
			</div>
			<h3 class="wdb-page-ready-tpl-title">
				<b>${single.title}</b>			
			</h3>				
			`;
        },
        
        setup_initial_templates: function (type) {   
           
            let pags = JSON.parse( wdb_import_obj.pages );
            $wdb_page_import.config.categories = pags.categories;          
            for (const [key, value] of Object.entries(pags.templates)) {
                $wdb_page_import.config.pages.push(value);  //
            }
            var output = [];
            output.push('<select class="wdb-page-select-type">');
            output.push('<option value="0">All</option>');
            jQuery.each($wdb_page_import.config.categories, function(i,item){
                if(item.id != 1){
                    output.push('<option value="'+ item.id +'">'+ item.title +'</option>');
                }
                
            });
            output.push('</select>');
            jQuery('.wdb-page-modal-content .wdb-page-subtype').html(output.join(''));
            $wdb_page_import.config.current_page = 0;
        },
        
        filter_category: function(){
            let id = parseInt($('.wdb-page-select-type :selected').val());                
         
            $wdb_page_import.config.filter_active = id === 0 ? 0 : 1;
            $wdb_page_import.config.current_page  = 0;
            $wdb_page_import.filter_cat_content(id);
            $wdb_page_import.mesonary_build();           
            jQuery('.wdb-templates-list-renderer .body-import-active-overlay').remove();
            jQuery('.wdb-templates-list-renderer').show();
            jQuery('.wdb-templates-list-renderer').siblings().hide();
            jQuery('.wdb-page-search-js').val('')
        },
        
        next_page_template: function () {
            
            $wdb_page_import.config.current_page = $wdb_page_import.config.current_page + 1;
            $wdb_page_import.mesonary_build();
        },

        prev_page_template: function () {           
           
            $wdb_page_import.config.current_page = $wdb_page_import.config.current_page - 1;
            $wdb_page_import.mesonary_build();
        },
        
        filter_content: function( user_input ){
           var obj = [...$wdb_page_import.config.pages];
           const pluck = (arr, key) => arr.map(i => i[key]);
           let filter_blocks = [];              
            if(Number.isInteger(user_input)){
                jQuery.each(obj, function (i, item) { 
                    var $ids = pluck(item.types, 'id'); // [8, 36, 34, 10]
                    if(jQuery.inArray(user_input, $ids) != -1) {
                        filter_blocks.push(item);          
                    }
                });
            }else{
                jQuery.each(obj, function (i, item) {  
                    var search_arr = item.title.toLowerCase().split(' ');           
                    if(jQuery.inArray(user_input.toLowerCase(), search_arr) != -1) {
                        filter_blocks.push(item);                
                    }   
                });
            }
          $wdb_page_import.config.search_content = filter_blocks;   
          return filter_blocks;
        },
        
        filter_cat_content: function( user_input ){
            var obj = [...$wdb_page_import.config.pages];
            const pluck = (arr, key) => arr.map(i => i[key]);
            let filter_blocks = [];             
          
             jQuery.each(obj, function (i, item) { 
                 var $ids = pluck(item.types, 'id'); // [8, 36, 34, 10]
                 if(jQuery.inArray(user_input, $ids) != -1) {
                     filter_blocks.push(item);          
                 }
             });
   
           $wdb_page_import.config.search_content = filter_blocks;   
           return filter_blocks;
        },
         
        findWord: function(word, str) {
            return RegExp('\\b'+ word +'\\b').test(str)
        },
        mesonary_build: function () {

            var eleemnt_type              = null;
            let row                       = document.querySelector('.wdb-templates-list-renderer');
            let element_wrapper           = document.createElement('div');                           // is a node
                element_wrapper.className = "wdb-row";
                row.innerHTML             = '';
            let data_status_found         = '';
            var templatesCopy = [];
            if($wdb_page_import.config.filter_active){
                templatesCopy = $wdb_page_import.config.search_content; 
            }else{
                templatesCopy = [...$wdb_page_import.config.pages];
            }
           
            var total_page    = 1;
                templatesCopy = templatesCopy.chunk_inefficient($wdb_page_import.config.per_page);  // page count
                total_page    = templatesCopy.length - 1;
            if (total_page >= $wdb_page_import.config.current_page) {
                templatesCopy = templatesCopy[$wdb_page_import.config.current_page];
            } else {
                templatesCopy = templatesCopy[0];
            }
          
            var pagination = document.createElement('div'); // is a node
            pagination.className = "wdb-templates-pagination";
            if ($wdb_page_import.config.current_page == 0) {
                pagination.innerHTML = '<ul><li class="wdb--page-tpls-button next"> Next </li> </ul>';
            } else if ($wdb_page_import.config.current_page === total_page) {
                pagination.innerHTML = '<ul><li class="wdb--page-tpls-button prev"> Prev </li> </ul>';
            } else {
                pagination.innerHTML = '<ul><li class="wdb--page-tpls-button prev"> Prev </li> <li class="wdb--page-tpls-button next"> Next </li> </ul>';
            }

            // Number of columns
            let cols = 4;

            var lg_tablet = window.matchMedia("(max-width: 1300px)");
            var tablet = window.matchMedia("(max-width: 1023px)");
            var mobile = window.matchMedia("(max-width: 767px)");

            if (lg_tablet.matches) {
                cols = 3;
            }

			if (tablet.matches) {
				cols = 2;
			}

            if (mobile.matches) {
                cols = 1;
            }

            let colsCollection = {};
            // Create number of columns
            for (let i = 1; i <= cols; i++) {
                colsCollection[`col${i}`] = document.createElement('div');
                colsCollection[`col${i}`].classList.add('wdb-template-list-column');
            }

            if (templatesCopy != undefined) {
                for (var i = 0; i < cols; i++) {
                    if (!templatesCopy[i]) break;
                    const itemContainer = document.createElement('div');
                    itemContainer.classList.add('wdb-item');
                    const item                  = document.createElement('div');
                          item.dataset.category = templatesCopy[i].title;
                          item.innerHTML        = $wdb_page_import.setup_loop_template(templatesCopy[i]);
                    itemContainer.appendChild(item);
                    colsCollection[`col${i + 1}`].appendChild(itemContainer);
                    if (i === cols - 1) {
                        templatesCopy.splice(0, cols);
                          // reset i
                        i = -1;
                    }
                }

                Object.values(colsCollection).forEach(column => {
                    element_wrapper.appendChild(column);
                });
            }
            if (data_status_found.length) {
                row.innerHTML = `<div class="wdb-tpl-not-found"> ${data_status_found} </div>`;
            } else {
                row.appendChild(element_wrapper);
            }

            if (total_page >= 1) {
                row.appendChild(pagination);
            }

        },
        run_importer_process: function(obj){
        
            jQuery.ajax({
                type    : "post",
                dataType: "json",
                url     : wdb_import_obj.ajax_url,
                timeout : 10000,
                data    : obj,
                success: function(response) {     
                   jQuery('.wdb-templates-list-renderer').hide();
                   if(response.success && 'step' in response.data && response.data.step === 'import'){
                        jQuery('.wdb-dpage-xml-import-container > .wdb-msg').html(response.data.html);
                        delete response.data.html;                        
                        $wdb_page_import.run_importer_process(response.data);
                   }                   
                   if(response.success && 'step' in response.data && response.data.step === 'done'){
                        jQuery('.wdb-dpage-xml-import-container > .wdb-msg').html(response.data.html);                      
                   }
                   
                   if(!response.success){
                    jQuery('.wdb-dpage-xml-import-container > .wdb-msg').html(response.data.html);          
                   }
                         
                }
            });
        }
     
    };
    
    $( document ).ready( $wdb_page_import.init );       
       
    
})(jQuery);