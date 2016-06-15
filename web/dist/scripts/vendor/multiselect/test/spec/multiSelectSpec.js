describe("multiSelect",function(){describe("init",function(){it("should be chainable",function(){select.multiSelect().addClass("chainable"),expect(select.hasClass("chainable")).toBeTruthy()}),describe("without options",function(){beforeEach(function(){select.multiSelect(),msContainer=select.next()}),it("should hide the original select",function(){expect(select.css("position")).toBe("absolute"),expect(select.css("left")).toBe("-9999px")}),it("should create a container",function(){expect(msContainer).toBe("div.ms-container")}),it("should create a selectable and a selection container",function(){expect(msContainer).toContain("div.ms-selectable, div.ms-selection")}),it("should create a list for both selectable and selection container",function(){expect(msContainer).toContain("div.ms-selectable ul.ms-list, div.ms-selection ul.ms-list")}),it("should populate the selectable list",function(){expect($(".ms-selectable ul.ms-list li").length).toEqual(10)}),it("should populate the selection list",function(){expect($(".ms-selectable ul.ms-list li").length).toEqual(10)})}),describe("with pre-selected options",function(){var e=[];beforeEach(function(){var t=select.children("option").first(),l=select.children("option").last();t.prop("selected",!0),l.prop("selected",!0),e.push(t.val(),l.val()),select.multiSelect(),msContainer=select.next()}),it("should select the pre-selected options",function(){$.each(e,function(e,t){expect($(".ms-selectable ul.ms-list li#"+sanitize(t)+"-selectable")).toBe(".ms-selected")}),expect($(".ms-selectable ul.ms-list li.ms-selected").length).toEqual(2)})}),describe("with disabled pre-selected options",function(){var e=["value1","value2","value3"];beforeEach(function(){$("#multi-select").find("option").first().prop("selected",!0).prop("disabled",!0).next().prop("selected",!0).next().prop("selected",!0).prop("disabled",!0),$("#multi-select").multiSelect()}),it("should select the disabled pre-selected options",function(){$.each(e,function(e,t){expect($(".ms-selectable ul.ms-list li#"+sanitize(t)+"-selectable")).toBe(".ms-selected")}),expect($(".ms-selectable ul.ms-list li.ms-selected").length).toEqual(3)})}),describe("with disabled non-selected options",function(){var e=["value1","value3"];beforeEach(function(){$("#multi-select").find("option").first().prop("selected",!0).next().prop("disabled",!0).next().prop("selected",!0),$("#multi-select").multiSelect()}),it("should not select the disabled non-selected options",function(){$.each(e,function(e,t){expect($(".ms-selectable ul.ms-list li#"+sanitize(t)+"-selectable")).toBe(".ms-selected")}),expect($(".ms-selectable ul.ms-list li.ms-selected").length).toEqual(2)})})}),describe("destroy",function(){describe("destroy multi select",function(){beforeEach(function(){select.multiSelect(),msContainer=select.next(),select.multiSelect("destroy")}),it("should show the original select",function(){expect(select.css("position")).not.toBe("absolute"),expect(select.css("left")).not.toBe("-9999px")}),it("should destroy the multiSelect container",function(){expect(select.next().size()).toEqual(0)})})}),describe("optgroup",function(){var e,t,l;beforeEach(function(){$('<select id="multi-select-optgroup" multiple="multiple" name="testy[]"></select>').appendTo("body");for(var e=1;10>=e;e++){for(var l=$('<optgroup label="opgroup'+e+'"></optgroup>'),i=1;10>=i;i++){var c=i+10*e;$('<option value="value'+c+'">text'+c+"</option>").appendTo(l)}l.appendTo($("#multi-select-optgroup"))}t=$("#multi-select-optgroup")}),describe("init",function(){describe("with selectableOptgroup option set to false",function(){beforeEach(function(){t.multiSelect({selectableOptgroup:!1}),e=t.next(),l=e.find(".ms-selectable .ms-optgroup-label")}),it("sould display all optgroups",function(){expect(l.length).toEqual(10)}),it("should do nothing when clicking on optgroup",function(){var e=l.first();e.trigger("click"),expect(t.val()).toBeNull()})}),describe("with selectableOptgroup option set to true",function(){beforeEach(function(){t.multiSelect({selectableOptgroup:!0}),e=t.next(),l=e.find(".ms-selectable .ms-optgroup-label")}),it("should select all nested options when clicking on optgroup",function(){var e=l.first();e.trigger("click"),expect(t.val().length).toBe(10)})})})}),describe("select",function(){describe("multiple values (Array)",function(){var e=["value1","value2","value7"];beforeEach(function(){$("#multi-select").multiSelect(),$("#multi-select").multiSelect("select",e)}),it("should select corresponding option",function(){expect(select.val()).toEqual(e)})}),describe("single value (String)",function(){var e="value1";beforeEach(function(){$("#multi-select").multiSelect(),$("#multi-select").multiSelect("select",e)}),it("should select corresponding option",function(){expect($.inArray(e,select.val())>-1).toBeTruthy()})}),describe("on click",function(){var e,t;beforeEach(function(){$("#multi-select").multiSelect(),e=$(".ms-selectable ul.ms-list li").first(),t=e.data("ms-value"),spyOnEvent(select,"change"),spyOnEvent(select,"focus"),e.trigger("click")}),it("should hide selected item",function(){expect(e).toBeHidden()}),it("should add the .ms-selected class to the selected item",function(){expect(e.hasClass("ms-selected")).toBeTruthy()}),it("should select corresponding option",function(){expect(select.find('option[value="'+t+'"]')).toBeSelected()}),it("should show the associated selected item",function(){expect($("#"+sanitize(t)+"-selection")).toBe(":visible")}),it("should trigger the original select change event",function(){expect("change").toHaveBeenTriggeredOn("#multi-select")}),afterEach(function(){select.multiSelect("deselect_all")})}),describe("on click on disabled non-selected option",function(){var e,t;beforeEach(function(){$("#multi-select").find("option").first().prop("disabled",!0),$("#multi-select").multiSelect(),e=$(".ms-selectable ul.ms-list li").first(),t=e.data("ms-value"),spyOnEvent(select,"change"),spyOnEvent(select,"focus"),e.trigger("click")}),it("should not hide selected item",function(){expect(e).not.toBeHidden()}),it("should not add the .ms-selected class to the selected item",function(){expect(e.hasClass("ms-selected")).not.toBeTruthy()}),it("should not select corresponding option",function(){expect(select.find('option[value="'+t+'"]')).not.toBeSelected()}),it("should not show the associated selected item",function(){expect($("#"+sanitize(t)+"-selection")).not.toBe(":visible")}),it("should not trigger the original select change event",function(){expect("change").not.toHaveBeenTriggeredOn("#multi-select")}),afterEach(function(){select.multiSelect("deselect_all")})})}),describe("deselect",function(){describe("multiple values (Array)",function(){var e=["value1","value2","value7"],t=["value1","value2"];beforeEach(function(){$("#multi-select").multiSelect(),$("#multi-select").multiSelect("select",e),$("#multi-select").multiSelect("deselect",t)}),it("should select corresponding option",function(){expect(select.val()).toEqual(["value7"])})}),describe("single value (String)",function(){var e=["value1","value2","value7"],t="value2";beforeEach(function(){$("#multi-select").multiSelect(),$("#multi-select").multiSelect("select",e),$("#multi-select").multiSelect("deselect",t)}),it("should select corresponding option",function(){expect($.inArray(t,select.val())>-1).toBeFalsy()})}),describe("on click",function(){var e,t,l;beforeEach(function(){$("#multi-select").find("option").first().prop("selected",!0),$("#multi-select").multiSelect(),e=$(".ms-selection ul.ms-list li").first(),t=e.data("ms-value"),l=$(".ms-selection ul.ms-list li").first(),spyOnEvent(select,"change"),spyOnEvent(select,"focus"),e.trigger("click")}),it("should hide clicked item",function(){expect(e).toBe(":hidden")}),it("should show associated selectable item",function(){expect($("#"+sanitize(t)+"-selectable")).toBe(":visible")}),it("should remove the .ms-selected class to the corresponding selectable item",function(){expect(l.hasClass("ms-selected")).toBeFalsy()}),it("should deselect corresponding option",function(){expect(select.find('option[value="'+t+'"]')).not.toBeSelected()}),it("should trigger the original select change event",function(){expect("change").toHaveBeenTriggeredOn("#multi-select")}),afterEach(function(){select.multiSelect("deselect_all")})}),describe("on click on disabled selected option",function(){var e,t,l;beforeEach(function(){$("#multi-select").find("option").first().prop("selected",!0).prop("disabled",!0),$("#multi-select").multiSelect(),e=$(".ms-selection ul.ms-list li").first(),t=e.data("ms-value"),l=$(".ms-selection ul.ms-list li").first(),spyOnEvent(select,"change"),spyOnEvent(select,"focus"),e.trigger("click")}),it("should not hide clicked item",function(){expect(e).not.toBe(":hidden")}),it("should not show associated selectable item",function(){expect($("#"+t+"-selectable")).not.toBe(":visible")}),it("should not remove the .ms-selected class to the corresponding selectable item",function(){expect(l.hasClass("ms-selected")).not.toBeFalsy()}),it("should not deselect corresponding option",function(){expect(select.find('option[value="'+t+'"]')).toBeSelected()}),it("should not trigger the original select change event",function(){expect("change").not.toHaveBeenTriggeredOn("#multi-select")}),afterEach(function(){select.multiSelect("deselect_all")})})})});