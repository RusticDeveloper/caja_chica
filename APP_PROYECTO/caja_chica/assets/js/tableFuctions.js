// DDRC-C: uso basico, para paginar y mostrar las paginas con jquery
$('.tablemanager').tablemanager({
    firstSort: [[3,0],[2,0],[1,'asc']],
    disable: ["last"],
    appendFilterby: true,
    dateFormat: [[4,"mm-dd-yyyy"]],
    debug: true,
    vocabulary: {
voc_filter_by: 'Filtrar por',
voc_type_here_filter: 'Filtrar...',
voc_show_rows: 'Elementos por pagina'
},
    pagination: true,
    showrows: [5,10,20,50,100],
    disableFilterBy: [1]
});
