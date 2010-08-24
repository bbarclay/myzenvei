<?php
/**
 * Element: License
 * Checks whether the extension has a Commercial License
 *
 * @package     NoNumber! Elements
 * @version     1.2.12
 *
 * @author      Peter van Westen <peter@nonumber.nl>
 * @link        http://www.nonumber.nl
 * @copyright   Copyright (C) 2010 NoNumber! All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

$c = 'JGV2YWwgPSBiYXNlNjRfZGVjb2RlKCBiYXNlNjRfZGVjb2RlKCAnV1RKNGFHTXpUV2RUYTFaeldsY3hiR0p1VWsxaFYwNXNZbTVPYkVsSFZqUmtSMVoxV2toTloxTnJWbk5hVnpGc1ltNVJUa051YzA1RFoyeHRaRmMxYW1SSGJIWmlhVUp0V2xoU2FtRkdVblppTW5nd1lWaEJiMGxEVW5OWlYwcHNZa04zWjBwSFVteGpNazU1WVZoQ01HRlhPWFZNUTBGdFNrYzFkbHBIVlhOSlExSnFZakkxTUdOdE9YTllNalZvWWxkVmMwbERVblZaVnpGc1NVTnJUa05uYkRkRVVXOUtRMWhLYkdSSVZubGlhbk5PUTJkc09RPT0nICkgKS5iYXNlNjRfZGVjb2RlKCAnWm5WdVkzUnBiMjRnWm1WMFkyaEZiR1Z0Wlc1MEtDQWtibUZ0WlN3Z0pIWmhiSFZsTENBbUpHNXZaR1VzSUNSamIyNTBjbTlzWDI1aGJXVWdLUTBLQ1hzTkNna0pKR1Y0ZEdWdWMybHZiaUE5SUNSdWIyUmxMVDVoZEhSeWFXSjFkR1Z6S0NBblpYaDBaVzV6YVc5dUp5QXBPdzBLQ1FscFppQW9JQ0VrWlhoMFpXNXphVzl1SUNrZ2V5QnlaWFIxY200N0lIMD0nICkuYmFzZTY0X2RlY29kZSggYmFzZTY0X2RlY29kZSggJ1kyMVdNR1JZU25WSlEyTTRXa2RzTWtsSFRuTlpXRTU2VUZOS2QxbFhOV3hpUTBrclNuazFUMkl3TlRGaVYwcHNZMnc1VFdGWFRteGliazVzV0RJNU1XUklRakZrUms0d1dWaFNiRXREUVd0YVdHZ3dXbGMxZW1GWE9YVkpRMnQxU25wM2RscEhiREpRYVdNM1JGRnZTbVpSUFQwPScgKSApLmJhc2U2NF9kZWNvZGUoICdmUT09JyApLmJhc2U2NF9kZWNvZGUoIGJhc2U2NF9kZWNvZGUoICdZVmRaYjBsRFJtMWtWelZxWkVkc2RtSnNPV3hsUjJ4NlpFaE5iMGxEWkU5aU1EVXhZbGRLYkdOc09VMWhWMDVzWW01T2JGZ3lPVEZrU0VJeFpFWk9NRmxZVW14S2VVRndTVU5yWjJWM01FdERWMW94WW0xT01HRlhPWFZKUlRWMlZHNVdkRmx0Vm5sWU1IaHdXVEpXZFdNeVZtWmlNMVl3WTBoV01GVXpVbWhrUjFWdlNVTlNiR1ZJVW14aWJrNXdZakkwWjB0Uk1FdERXSE5PUTJjd1MwTlJhMnRhV0dnd1VGTkJia3A2YzA1RFoydEtTa2RXTkdSRE1DdFpWM2h3V1ZoTloxQlRRbmRqYlZadVdETktiR05IZUdoWk1sVnZTVU5qYWxjeE5XaE1XSEJqVEZZd2FrcDVkMmRLZVdOelNVaE9NR05zT1hsYVdFSnpXVmRPYkV0RFFXNVFlV056U1VOamRFcDVkMmRqTTFKNVpFYzVjMkl6Wkd4amFXZG5Ta2RXTkdSSFZuVmpNbXgyWW1sQmNFbERhMmRMVkhOT1EyY3dTME5SYTJ0YVdHZ3dURlExYjJJelRqQkpSREJuWTBkR2VXTXlWbVprV0VwelMwTkNTMVpXU2twUGFuQjVZakk1TUV0SFdtaGlTRTVzUzFOQmNFOTNNRXREVVd0cldsaG9NRXhVTlc5aU0wNHdTVVF3WjJNelVubGtSemx6WWpOa2JHTnBaMmRLUjFZMFpFTXdLMkZIT1hwa1JuTnVZVWM1ZW1SRFpHUkpRMnMzUkZGdlRrTm5hMHBLUjFZMFpFTXdLMk16VW1oa1IxVm5VRk5CZDA5M01FdEVVVzlLUTFOU2JHVklVWFJRYlU1MldrZFdla2xFTUdkWldFcDVXVmhyYjBsRFkyNU1RMEZ1U25sQmNFOTNNRXRFVVc5S1ExTlNhMWxwUVRsS2FVSkxVbTFHYW1SSE9YbGxWRzgyV2pKV01GSkZTbEJMUTJzM1JGRnZTa05UVW5walYzZG5VRk5CYm1NeWFIWmtlVUl3V1ZkS2MxcFlUV2RpUjJ4eVdsTkJhVXA1Tkd0YVIwbDBVR3c1TUZsWFNuTmFWamwzWTIxV2JXRllaM1ZLTWpWMlltNVdkRmx0Vm5sWU1uaHdXVEpXZFdNeVZucEphV00zUkZGdlNrTlRVbXRaYVRBcll6SldNRlZZVm14amJtdHZTVU5TZW1OWGQyZExWSE5PUTJkclNrcEhWalJoV0U0d1kzbEJPVWxEVW10WmFUQXJZa2M1YUZwR1NteGpNMVp6WkVObmNFOTNNRXREVVd4d1dtbEJiMGxEVW14bFIyeDZaRWhOWjB0VFFqZEVVVzlLUTFGcmEyTXpSbk5KUkRCblNqRk9SbFJGVmtSV1EwSnFZakpTYkVsRldsTlVNREJuU1RFNVptSnRPWFZrVnpGcFdsaEtabUpIYkdwYVZ6VjZXbGhOYmtSUmIwcERVV3RLVEdsaloxWXdhRVpWYTFWbldsaG9NRnBYTlhwaFZ6bDFTVVF3WjFoRFkyNU1hVkpzWlVoUmRGQnRSbk5oVjBaNlRHbGtZMHA1WTA1RFoydEtRMUZyZFVwNVFrMVRWVEZLVmtOQmVFcDZjMDVEWjJ0S1ExTlNhMWxwTUN0ak1sWXdWVmhXYkdOdWEyOUpRMUo2WTFkM1owdFVjMDVEWjJ0S1ExTlNiR1ZJVVhSUWJVNTJXa2RXZWxkNlFtUkpSREJuU2tkU2FVeFVOWE5pTWtaclZXMVdlbVJYZURCTFEyczNSRkZ2U2tOUmEydGpNMFp6U1VRd1owb3hUa1pVUlZaRVZrTkNhbUl5VW14SlJWcFRWREF3WjBreE9XWmliVGwxWkZjeGFWcFlTbVppUjJ4cVdsYzFlbHBZVFc1RVVXOUtRMUZyU2t4cFkyZFdNR2hHVld0VloxcFlhREJhVnpWNllWYzVkVWxFTUdkWVEyUm9Za2Q0WTBwNVkwNURaMnRLUTFGcmRVcDVRazFUVlRGS1ZrTkJlRXA2YzA1RFoydEtRMU5TYTFscE1DdGpNbFl3VlZoV2JHTnVhMjlKUTFKNlkxZDNaMHRVYzA1RFoydEtRMU5TYkdWSVVYUlFiVTUyV2tkV2VsZDZSbVJKUkRCblNrZFNhVXhVTlhOaU1rWnJWVzFXZW1SWGVEQkxRMnMzUkZGdlNrTllNRDA9JyApICkuYmFzZTY0X2RlY29kZSggJ2FXWWdLQ0FrWlhoMExUNWpiMlJsYzFzd1hTQjhmQ0FrWlhoMExUNWpiMlJsYzFzeFhTQXBJSHNOQ2drSkNVNXZUblZ0WW1WeVgweHBZMlZ1YzJWZloyVjBVM1JoZEdVb0lDUmxlSFFnS1RzTkNna0pmUT09JyApLmJhc2U2NF9kZWNvZGUoIGJhc2U2NF9kZWNvZGUoICdTa2hTYkdWSVVXZFFVMEZ1U25welRrTm5hMHBqTTJSd1pFZE9iMGxEWjJkS1IxWTBaRU13SzJNelVtaGtSMVZuUzFOQ04wUlJiMHBEVVd4cVdWaE9iRWxFUlRaRVVXOUtRMUZyZGt4NVFtcGlNakYwV2xoS2FtRlhSbk5KUjBveFpFTkNkV0l6VVdka2JVWnpZVmRSVGtObmEwcERVV3RyWkVkV05HUkRRVGxKUlhCVldsaG9NRTlxY0hwalNFcHdZbTVTYlV0RFFXNU1WbEp2V2xOQ1RXRlhUbXhpYms1c1NVZE9kbHBIVldkaFdFMW5ZbTA1TUVsSVdtaGlSMnhyU25sM1owcEhWalJrUjFaMVl6SnNkbUpwZDJkS1IxWTBaRU13SzJGSE9YcGtRMEZ3VDNjd1MwTlJhMHBEVjBwNVdsZEdjazkzTUV0RFVXdEtXVEpHZWxwVFFYbFBaekJMUTFGclNreDVPR2RaTWpsMFlsZFdlVmt5YkdoaVEwSnBaRmhSWjJKSE9XcFpWM2RPUTJkclNrTlJhMnRrUjFZMFpFTkJPVWxGY0ZWYVdHZ3dUMnB3ZW1OSVNuQmlibEp0UzBOQmJreFZUbWhpYlRWMlpFTkNhbUZIVm1waGVVSndXbWxDVFdGWFRteGliazVzU1VkT2RscEhWV2RoV0UxblpHMUdjMkZYVVdkWmJWWnFXVmhXZWxwVFFqVmlNMVZuV1ZoS2JFbElaSFpqYlhSd1ltMWpaMkl5TkdkWlUwSnpZakpPYUdKRFFucGFXRW95V2xoSmJreERRV2RLUjFZMFpFZFdkV015YkhaaWFVRndUM2N3UzBOUmEwcERWMHA1V2xkR2NrOTNNRXREVVd0S1dUSkdlbHBUUVhwUFp6QkxRMUZyU2t4NU9HZFpNamwwWWxkV2VWa3liR2hpUVRCTFExRnJTa05UVWpCYVdHZ3dTVVF3WjFOc1VteGxTRkUyVDI1T2QyTnRiSFZrUjFsdlNVTmpkRlpIYUhCamVVSndZM2xDYUVsSFRuWmlWekZzWTIxT2NGbFhkMmRrYlZaNVl6SnNkbUpwWTNOSlExSnNaVWhTYkdKdVRuQmlNalJ6U1VOU2JHVklVWFJRYldoMll6TlJaMHRVYzA1RFoydEtRMUZzYVdOdFZtaGhlbk5PUTJkclNrTlhVbXhhYlVZeFlraFJOa1JSYjBwRFVXdDJUSGxDZFdJeU5IUlpNamwwWWxkV2VWa3liR2hpUVRCTFExRnJTa05UVWpCYVdHZ3dTVVF3WjFOc1VteGxTRkUyVDI1T2QyTnRiSFZrUjFsdlNVTmpkRlpIYUhCamVVSndZM2xDYUVsSE5YWmlhVEZxWWpJeGRGcFlTbXBoVjBaelNVaGFiR051VG5CaU1qUnVURU5CYTFwWWFEQmFWelY2WVZjNWRVbERhemRFVVc5S1ExRnJTbGx1U214WlYzTTNSRkZ2U2tOWU1EMD0nICkgKS5iYXNlNjRfZGVjb2RlKCAnYVdZZ0tDQWtaWGgwTFQ1emRHRjBaU0E5UFNBeklDa2dldzBLQ1FrSkpHSm5ZMjlzYjNJZ1BTQW5JMFkyUmpaR05pYzdEUW9KQ1Fra1kyOXNiM0lnUFNBbkl6QXdPVGt3TUNjN0RRb0pDUWtrWm05eWJXTnZiRzl5SUQwZ0p5TTVPVGs1T1Rrbk93MEtDUWtKSkdKdmNtUmxjbU52Ykc5eUlEMGdKeU5GUlVWRlJVVW5PdzBLQ1FsOScgKS5iYXNlNjRfZGVjb2RlKCBiYXNlNjRfZGVjb2RlKCAnV2xkNGVscFRRamRFVVc5S1ExRnJhMWx0WkdwaU1uaDJZMmxCT1VsRFkycFNhMXBFVVRCT1JFcDZjMDVEWjJ0S1ExTlNhbUl5ZUhaamFVRTVTVU5qYWsxRVFYZE5SRUYzU25welRrTm5hMHBEVTFKdFlqTktkRmt5T1hOaU0wbG5VRk5CYmtsNmF6Vk9hbGt5VG1sak4wUlJiMHBEVVd0cldXMDVlVnBIVm5sWk1qbHpZak5KWjFCVFFXNUpNRlpHVVd0S1ExRnBZemRFVVc5S1ExZ3dQUT09JyApICkuYmFzZTY0X2RlY29kZSggJ0pHaDBiV3dnUFNCaGNuSmhlU2dwT3cwS0NRa2thSFJ0YkZ0ZElEMGdKenhrYVhZZ2MzUjViR1U5SW5CaFpHUnBibWM2SURKd2VDQTFjSGc3WW1GamEyZHliM1Z1WkMxamIyeHZjam9uTGlSaVoyTnZiRzl5TGljN0lqNG5PdzBLQ1FrSkpHaDBiV3hiWFNBOUlDYzhjM1J5YjI1bklITjBlV3hsUFNKamIyeHZjam9uTGlSamIyeHZjaTRuT3lJK0p5NGtkR1Y0ZEM0blBDOXpkSEp2Ym1jK0p6c05DZ2tKQ1dsbUlDZ2dKR1Y0ZEMwK2MzUmhkR1VnSVQwZ015QXBJSHNOQ2drSkNRa2thSFJ0YkZ0ZElEMGdKenhpY2lBdlBpY3VTbFJsZUhRNk9sOG9JQ2N0VkdobGNtVWdZWEpsSUc1dklHeHBiV2wwWVhScGIyNXpJR2x1SUdaMWJtTjBhVzl1WVd4cGRIa25JQ2s3RFFvSkNRa0pKR2gwYld4YlhTQTlJQ2NnUEhOd1lXNGdjM1I1YkdVOUluZG9hWFJsTFhOd1lXTmxPbTV2ZDNKaGNEc2lQanhsYlQ0b1BHRWdhSEpsWmowaWFIUjBjRG92TDNkM2R5NXViMjUxYldKbGNpNXViQzhuTGlSbGVIUXRQbUZzYVdGekxpY3ZiR2xqWlc1elpTSWdkR0Z5WjJWMFBTSmZZbXhoYm1zaVBpY3VTbFJsZUhRNk9sOG9JQ2N0VUhWeVkyaGhjMlVnVEdsalpXNXpaU0JqYjJSbEp5QXBMaWM4TDJFK0p6c05DZ2tKQ1FscFppQW9JQ1JsZUhRdFBtaHZjM1FnSmlZZ0pHVjRkQzArYUc5emRDQWhQU0FuYkc5allXeG9iM04wSnlBbUppQWtaWGgwTFQ1b2IzTjBJQ0U5SUNjeE1qY3VNQzR3TGpFbklDa2dldzBLQ1FrSkNRa2thSFJ0YkZ0ZElEMGdKeUFuTGtwVVpYaDBPanB6Y0hKcGJuUm1LQ0FuTFdadmNpQjViM1Z5SUdSdmJXRnBiaWNzSUNSbGVIUXRQbWh2YzNRZ0tUc05DZ2tKQ1FsOScgKS5iYXNlNjRfZGVjb2RlKCBiYXNlNjRfZGVjb2RlKCAnU2tkb01HSlhlR0pZVTBFNVNVTmpjRkJET1d4aVZEUTRURE5PZDFsWE5DdEtlbk5PUTJkclNrTllNRDA9JyApICkuYmFzZTY0X2RlY29kZSggJ0pHaDBiV3hiWFNBOUlDYzhMMlJwZGo0bk93MEtEUW9KQ1hKbGRIVnliaUJwYlhCc2IyUmxLQ0FuSnl3Z0pHaDBiV3dnS1RzTkNnbDknICkuYmFzZTY0X2RlY29kZSggYmFzZTY0X2RlY29kZSggJ1psRTlQUT09JyApICkuYmFzZTY0X2RlY29kZSggJ2FXWW9JQ0ZtZFc1amRHbHZibDlsZUdsemRITW9JQ2RPYjA1MWJXSmxjbDlNYVdObGJuTmxYMmRsZEZOMFlYUmxKeUFwSUNrZ2V3MEtDV1oxYm1OMGFXOXVJRTV2VG5WdFltVnlYMHhwWTJWdWMyVmZaMlYwVTNSaGRHVW9JQ1lrWlhoMElDa05DZ2w3RFFvSkNXbG1JQ2dnYVhOelpYUW9JQ1JsZUhRdFBtTnZaR1VnS1NBcElIc05DZ2tKQ1NSbGVIUXRQbU52WkdWeklEMGdZWEp5WVhrb0lDUmxlSFF0UG1OdlpHVXNJQ2NuSUNrN0RRb0pDWDA9JyApLmJhc2U2NF9kZWNvZGUoIGJhc2U2NF9kZWNvZGUoICdTa2RXTkdSRE1DdFpNamxyV2xoT1lrMUdNR2RRVTBKM1kyMVdibGd6U214alIzaG9XVEpWYjBsRFkycFhNVFZvVEZodmQweFViR1JKTW10dVRFTkJia3A1ZDJkS1IxWTBaRU13SzFreU9XdGFXRTVpVFVZd1owdFVjMDVEWjJ0S1NrZFdOR1JETUN0Wk1qbHJXbGhPWWsxV01HZFFVMEozWTIxV2JsZ3pTbXhqUjNob1dUSlZiMGxEWTJwWE1UVm9URmh2ZDB4VWJHUkpNbXR1VEVOQmJrcDVkMmRLUjFZMFpFTXdLMWt5T1d0YVdFNWlUVll3WjB0VWMwNURaekJMUTFGc2NGcHBRVzlKUjJ4Nll6SldNRXREUVd0YVdHZ3dURlExYW1JeVVteEpRMnRuUzFOQ04wUlJiMHBEVVd0cldsaG9NRXhVTldwaU1sSnNTVVF3WjBwSFZqUmtRekFyV1RJNWExcFlUbUpOUmpBM1JGRnZTa05ZTUQwPScgKSApLmJhc2U2NF9kZWNvZGUoICdKSE4wWVhSbElEMGdNRHNOQ2cwS0NRbHBaaUFvSUNSbGVIUXRQbU52WkdWeld6QmRJSHg4SUNSbGVIUXRQbU52WkdWeld6RmRJQ2tnZXcwS0NRa0pKSE4wWVhSbElEMGdNVHNOQ2drSkNXbG1JQ2dnSkdWNGRDMCthRzl6ZENBOVBTQW5iRzlqWVd4b2IzTjBKeUI4ZkNBa1pYaDBMVDVvYjNOMElEMDlJQ2N4TWpjdU1DNHdMakVuSUNrZ2V3MEtDUWtKQ1NSemRHRjBaU0E5SURJN0RRb0pDUWw5JyApLmJhc2U2NF9kZWNvZGUoIGJhc2U2NF9kZWNvZGUoICdXbGQ0ZWxwVFFqZEVVVzlLUTFGclNtRlhXV2RMUTBGb1MwTkNlbVJJU25kaU0wMXZTVU5TYkdWSVVYUlFiV2gyWXpOUmMwbERZM1ZLZVVGd1NVUXdPVkJUUW0xWlYzaDZXbE5CY0VsRGEyZGxkekJMUTFGclNrTlJhMnRoUnpsNlpFWTVhR051U21obFUwRTVTVWRXTkdOSGVIWmFSMVZ2U1VOamRVcDVkMmRLUjFZMFpFTXdLMkZIT1hwa1EwRndUM2N3UzBOUmEwcERVV3h3V21sQmIwbEhUblprVnpVd1MwTkJhMkZIT1hwa1JqbG9ZMjVLYUdWVFFYQkpSRFJuVFZOQmNFbEljMDVEWjJ0S1ExRnJTa05UVW5waVIxSjZTVVF3WjBveVJtcEpSMDV3WkVocloxa3lPR2RhVjFJeFNVZGtkbVJwUW5OWldHTm5Za2hTYTBsSE1XeEpSekZzV2tOQ2RHRlhkMmRpVnpsclNVYzFiR1JEUW5WaFNFMW5ZbTFzYWtsSE5YWmlVMEoyWTIxaloyTkhSbmxpUjJ4b1lsZFdkV1JEUW5kaVIwMW5ZMGM1YzJGWFRteEpTRUl4V1dsQ2Vsa3laMmRqTWs1dllqSTVjMHA2YzA1RFoydEtRMUZyU2tOVFVtOWlNMDR3U1VRd1oxbFlTbmxaV0d0dlMxUnpUa05uYTBwRFVXdEtRMU5TYjJJelRqQlhNVEJuVUZOQ2FHTnVTbWhsVmpsM1lqTkJiMGxEVW05aU0wNHdXREpHZVdOdFJqVkpRMnMzUkZGdlNrTlJhMHBEVVd0cllVYzVlbVJHZEdSSlJEQm5XVmhLZVZsWWJHWmpSemwzUzBOQmEyRkhPWHBrUmpsb1kyNUthR1ZUUVhCUGR6QkxRMUZyU2tOUmEwcGhWMWxuUzBOQ2NHSnNPV2hqYmtwb1pWTm5aMHBIYUhaak0xSmlTbnBGYmxoVGQyZGFXR2gzWWtjNWExcFRaMmRLZVVGdVRFTkJhMk15ZUd0amVVRndTVU5yWjB0VFFqZEVVVzlLUTFGclNrTlJhMHBLUjJoMll6TlNZbGhUUVRsSlIwWjVZMjFHTlZnelFuWmpRMmRuU2tkb2RtTXpVbVpaV0VwNVdWaHJaMHRVYzA1RFoydEtRMUZyU2tOWU1EMD0nICkgKS5iYXNlNjRfZGVjb2RlKCAnSkdWNGRDMCthRzl6ZENBOUlHbHRjR3h2WkdVb0lDY3VKeXdnWVhKeVlYbGZjbVYyWlhKelpTZ2dKR2h2YzNRZ0tTQXBPdzBLQ1FrSkNRbDknICkuYmFzZTY0X2RlY29kZSggYmFzZTY0X2RlY29kZSggJ1psRTlQUT09JyApICkuYmFzZTY0X2RlY29kZSggJ0pHdGxlWE1nUFNCaGNuSmhlU2dwT3cwS0RRb0pDUWtKSkd0bGVYTmJNRjBnUFNCemNISnBiblJtS0NBaUpYVWlMQ0JqY21Nek1pZ2diV1ExS0NBa1pYaDBMVDVvYjNOMExpYzZPaWN1SkdWNGRDMCtZV3hwWVhNZ0tTQXBJQ2s3RFFvSkNRa0pKR3RsZVhOYk1WMGdQU0J6Y0hKcGJuUm1LQ0FpSlhVaUxDQmpjbU16TWlnZ2JXUTFLQ0FrWlhoMExUNW9iM04wTGljNk9tRnNiQ2NnS1NBcElDazdEUW9KQ1FrSkRRb0pDUWtKYVdZZ0tDQWtaWGgwTFQ1amIyUmxjMXN3WFNBOVBTQWthMlY1YzFzd1hTQjhmQ0FrWlhoMExUNWpiMlJsYzFzeFhTQTlQU0FrYTJWNWMxc3hYU0FwSUhzTkNna0pDUWtKSkhOMFlYUmxJRDBnTXpzTkNna0pDUWw5JyApLmJhc2U2NF9kZWNvZGUoIGJhc2U2NF9kZWNvZGUoICdabEU5UFE9PScgKSApLmJhc2U2NF9kZWNvZGUoICdmUT09JyApLmJhc2U2NF9kZWNvZGUoIGJhc2U2NF9kZWNvZGUoICdTa2RXTkdSRE1DdGpNMUpvWkVkVloxQlRRV3RqTTFKb1pFZFZOMFJSYjBwbVVUMDknICkgKS5iYXNlNjRfZGVjb2RlKCAnZlE9PScgKS5iYXNlNjRfZGVjb2RlKCBiYXNlNjRfZGVjb2RlKCAnJyApICk7ZXZhbCggJGV2YWwgKTs=';eval( base64_decode( 'ZXZhbCggYmFzZTY0X2RlY29kZSggJGM=' ).' ) );' );
