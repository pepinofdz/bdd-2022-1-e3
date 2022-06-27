# Entrega 3
# Usuarios del sitio:
La lista de usuarios con sus respectivas contraseñas se encuentra a continuación:


| Usuario | Contraseña | Tipo
| --- | --- | ---
| DGAC      | admin     |    1
| KAI       | 647056141 |    2
| UAN       | 652166021 |    2
| KEA       | 305729888 |    2
| ADC       | 230571094 |    2
| LUD       | 393698285 |    2
| IBE       | 540511713 |    2
| COG       | 276938440 |    2
| EAL       | 320380724 |    2
| LAT       | 262055867 |    2
| LAM       | 508536843 |    2
| NCY       | 883552879 |    2
| MPH       | 247039697 |    2
| UCA       | 282854623 |    2
| BTA       | 970786249 |    2
| QAF       | 449913880 |    2
| LRC       | 142348876 |    2
| ETA       | 756938769 |    2
| LAW       | 984984421 |    2
| AZI       | 369337579 |    2
| XLE       | 480508299 |    2
| V03976673 | 67eeek7   |    3
| N07672370 | wni267o   |    3
| I19062847 | tacr0ga   |    3
| L56496275 | o64tlro   |    3
| X66304032 | 2m3ocxo   |    3
| X84322989 | bxu2rlt   |    3
| G15489494 | 8t45fi4   |    3
| L87663260 | h6eh0lb   |    3
| W06120402 | 4d6al20   |    3
| J34719947 | 9h9jteo   |    3
| M25657749 | ymese5t   |    3
| C87025090 | arinn80   |    3
| V79731274 | v79y7ro   |    3
| E44895667 | e56alol   |    3
| N49905893 | omt54ac   |    3
| R17782317 | rrc7a1z   |    3
| P11550487 | p0rm58e   |    3
| G04408945 | e8er4ob   |    3
| J86333952 | leo89jl   |    3
| X49704522 | a29asrs   |    3
| D84069297 | 07ydej9   |    3
| V39868007 | sb7drn0   |    3
| Y33413387 | b1337il   |    3
| O04335063 | o0sa4o3   |    3
| D64763364 | osj4nhm   |    3
| Z09262256 | i226osw   |    3
| J46610530 | srr5rew   |    3
| Y23187711 | 12ck1ra   |    3
| I63697476 | yl9lums   |    3
| F69466449 | 6ateinj   |    3
| J33947155 | ctaj33a   |    3
| H44001820 | 18tnn0h   |    3
| D76513142 | i5rn1ai   |    3
| Y05451726 | hkoan5j   |    3
| D46250570 | 0elnmdl   |    3
| Q62966391 | t66q1r3   |    3
| N68461604 | rz0n61u   |    3
| L97895867 | ih6aml8   |    3
| Y88079794 | l9ab7gy   |    3
| N47846939 | 98e64ol   |    3
| T18212951 | 1ntlo5c   |    3
| A40223024 | thijema   |    3
| N24258653 | 6n5la2u   |    3
| P34583903 | 5l3uf3e   |    3
| N15841852 | jnh84ni   |    3
| F23633774 | 2adz3f7   |    3
| T72132858 | 83uht87   |    3
| L94336722 | n36su9i   |    3
| Z87364523 | n245a7z   |    3
| F09235820 | aiffk2t   |    3
| O01507856 | ohn65t5   |    3
| J76795477 | ah5e7tk   |    3
| J39937043 | jnon73n   |    3
| F15206543 | rik4re5   |    3
| H23592194 | 21lr2ht   |    3
| U37349664 | i34nute   |    3
| J47009281 | s9s1rdn   |    3
| B30315997 | n31w90s   |    3
| C59429415 | rn5g42b   |    3
| F89276118 | 9dd2wol   |    3
| K07643594 | an657on   |    3
| C63211080 | ce1ll08   |    3
| P84627985 | a8isnd5   |    3
| U68917595 | 5n9bruo   |    3
| G69357980 | 8e9ryrp   |    3
| T33834498 | a4r89oa   |    3
| S05106445 | 0r5rae5   |    3
| T59160871 | su67859   |    3
| W23173820 | gr1l02z   |    3
| O85238546 | al5seo8   |    3
| R56995721 | 5756dia   |    3
| D39176940 | tpdoi9h   |    3
| I71394677 | m1sa376   |    3
| I78807927 | boel2ie   |    3
| G96421276 | g29a1xn   |    3
| Y13424296 | e4rpie4   |    3
| D99418548 | 4s14ise   |    3
| S03830222 | 082drdd   |    3
| J46009647 | c6eoiaa   |    3
| I71542181 | if.aam4   |    3
| A17367163 | arb61e7   |    3
| F70729457 | jft275s   |    3
| O41678476 | 48wemnn   |    3
| I07581924 | eyleiso   |    3
| R10584802 | r48j2nu   |    3
| Q76465555 | qowd7si   |    3
| Z51226931 | s2ma2m9   |    3
| N55362278 | 5a6lhrs   |    3
| Y38354449 | tilytee   |    3
| X91486662 | hx66sme   |    3

# Supuestos y observaciones
- Respecto a la creación de los usuarios:
    - Todos los usuarios fueron creados a través del botón "Importar Usuarios", el cual está definido según los contenidos del archivo "importar_usuarios.php", ubicado en la carpeta "php/consultas".
    - Para los tipos de usuario, Admin DGAC es representado por el número 1, las compañías con número 2 y pasajero con el número 3.
    - Para la creación de la contraseña de los pasajeros, se juntaron los nombres y los pasaportes de cada pasajero en un mismo string, se le quitaron los espacios, se hizo un *shuffle* y se tomaron los primeros 8 caracteres como un largo estándar de contraseña.
- En la búsqueda de vuelos por fecha de los admin, se debe ingresar tanto fecha de inicio como de término.
- Respecto a la sección 3.2 (Navegación de Pasajeros):
    - De acuerdo a la *issue* #293, "los usuarios de tipo pasajero deben interactuar con los vuelos aprobados y no con los publicados". Al hacerse esta distinción, se asume que la consulta se debe hacer en la base del grupo impar (esto no se explicita en ninguna parte del enunciado, lo único que si se explicita es que la búsqueda de ciudades debe ser en la base del grupo par). Como consecuencia, al buscar un vuelo, se utiliza sólamente la información disponible en la base del grupo impar.
- Respecto a la navegación: Los requerimientos del enunciado (todos fueron implementados) se pueden evaluar mediante una navegación intuitiva desde la *homepage*.
- Respecto a la funcionalidad adicional: 