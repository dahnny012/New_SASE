moment().format();
var query = "https://new-sase-dahnny012.c9.io/API/event.php?msg=query";



var Event = React.createClass({
    getInitialState: function() {
        return {
            event:"",
            editMode:false,
            delete:false
        };
    },
    componentDidMount:function(){
        this.setState({
            event:this.props.event
        })
    },
    render:function(){
        var re = this;
        if(this.state.delete)
            return null;
        if(this.state.editMode){
            return (<div className="event card blue darken-4">
            <div className="card-content white-text">
               <input type="text" className="card-title" value={this.state.event.Name}/>
               <p>
                  <input type="text" className="card-title" value={this.state.event.Date}/>
                  <input type="text" className="card-title" value={this.state.event.Time}/>
                  <input type="text" className="card-title" value={this.state.event.Location}/>
                  <p>
                  <textarea name="" className="materialize-textarea" value={this.state.event.Description}></textarea>
                  </p>
                  <input type="text" className="card-title" value={this.state.event.FB}/>
               </p>
            </div>
            <div className="card-action">
               <button onClick={function(){
                   
               }}>Add</button>
               <button onClick={function(){
                   re.setState({
                       editMode:false
                   });
               }}>Cancel</button>
            </div>
         </div>)
        }
        return (<div className="events" key={this.state.event.EID}>
             <div className="event card blue darken-4">
                <div className="card-content white-text">
                   <span className="card-title">{this.state.event.Name}</span>
                   <p>
                      <span className="eventLogistics">{this.state.event.Date} {this.state.event.Time} {this.state.event.Location}</span>
                      <br>
                      {this.state.event.Description}
                      <br/>
                      <a className="btn-floating" href={this.state.event.FB}>FB</a>
                      </br>
                   </p>
                </div>
                <div className="card-action">
                   <button onClick={function(){
                       re.setState({
                           editMode:true
                       });
                   }}>Edit</button>
                   <button onClick={function(){
                       $.get(query,{msg:"query",eid:re.state.event.EID},function(data){
                           console.log(re.state.event.EID);
                            re.setState({
                                delete:true
                            });
                        }.bind(re));
                   }}>Delete</button>
                </div>
             </div>
             </div>);
    }
})

var EventList = React.createClass({
    getInitialState: function() {
        return {
            events:[""]
        };
    },

    componentDidMount: function() {
        $.get(this.props.source,{msg:"query"},function(data){
            data = JSON.parse(data);
            /*
            for(var i=3; i<100; i++){
                var gg = $.extend(true, {}, data[0]);
                gg.EID = i;
                gg.Name = i;
                data.push(gg);
            }
            */
            this.setState({
                events:data
            });
        }.bind(this));
    },

    render: function() {
        var re = this;
        var nodes =  this.state.events.map(function(e){
            return (<Event
            event = {e}
            key={e.EID}
            />)
        });
        return (<div>
        {nodes}
        </div>)
        
    }
});

var Modal = React.createClass({
    getInitialState:function(){
        return {
            show:false
        }
    },
    onClick:function(){
        if(this.state.show){
            this.setState({
                show:false
            });
        }else{
            this.setState({
                show:true
            })
        }
        },
    render:function(){
        return (  <div id="eventForm" className="">
    <button onClick={this.onClick} className="btn"> {this.state.show ? "Cancel" : "Add a Event"} </button>
    {this.state.show ? <EventForm/> : null}
    </div>)
    }
});

var EventForm = React.createClass({
    render:function(){
        return (
    <div className="formWrapper">
        <div className="row">
          <div className="col s6 offset-s2">
                  <h2 className="header">Add a Event</h2>
          </div>
        </div>
        <div className="row">
      <div className="col s4 offset-s2">
        <label>Name</label>
        <input type="text"/>
      </div>
      <div className="col s4">
        <label> Date</label>
        <input type="text"/>
      </div>
    </div>

    <div className="row">
      <div className="col s4 offset-s2">
        <label>Location</label>
        <input type="text"/>
      </div>
      <div className="col s4">
        <label>Time</label>
        <input type="text"/>
      </div>
    </div>

    <div className="row">
      <div className="col s4 offset-s2">
        <label>Facebook Link</label>
        <input type="text"/>
      </div>
      <div className="col s4">
        <label>Description</label>
        <textarea name="address" className="materialize-textarea"></textarea>
      </div>
    </div>
        <div className="row">
        <div className="col s4 offset-s2">
      <button className="btn">Submit</button>
      </div>
    </div>
    </div>);
    },
}); 


React.render( <EventList source = "https://new-sase-dahnny012.c9.io/API/event.php?msg=query"/> 
, document.getElementById("events"));


React.render(<Modal/>,document.getElementById("Modal"));