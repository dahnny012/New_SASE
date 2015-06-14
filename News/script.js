var query = "https://new-sase-dahnny012.c9.io/API/news.php?msg=query";
var post = "https://new-sase-dahnny012.c9.io/API/news.php";
var fields = ["Title","Date","Content","ImageSrc"];


var News = React.createClass({
    getInitialState: function() {
        return {
            news:"",
            editMode:false,
            delete:false,
            changeQueue:{}
        };
    },
    componentDidMount:function(){
        this.setState({
            news:this.props.news
        });
    },
    queueChange:function(e){
        var temp = this.state.changeQueue;
        temp[e.target.name] = e.target.value;
        this.setState({
            changeQueue:temp
        });
    },
    handleDelete:function(e){
         $.post(post, {
             msg: "delete",
             NID: this.state.news.NID
         }, function(data) {
             data = JSON.parse(data);
             if (data.status !== "success") {
                 alert("Delete was not successful");
                 return;
             }
             this.setState({
                 delete: true
             });

         }.bind(this));
    },
    handleEdit:function(){
        this.setState({
            editMode:true
        });
    },
    render:function(){
        var re = this;
        if(this.state.delete)
            return null;
        if(this.state.editMode){
            return (<div className="event card blue darken-4">
            <div className="card-content white-text">
                <input type="text" placeholder="Title" name="Title" className="card-title" defaultValue={this.state.news.Title} onChange={this.queueChange}/>
                <input type="text" placeholder="Date" name="Date" className="card-title" defaultValue={this.state.news.Date} onChange={this.queueChange}/>
                <textarea name="" placeholder="Content" name="Content" className="materialize-textarea" defaultValue={this.state.news.Content} onChange={this.queueChange}/>
                <input type="file"/>
                <input type="url" placeholder="Url"/>
            </div>
            <div className="card-action">
            
               <button onClick={function(){
                   // Copy Over All Non Changed Data
                   var temp = re.state.changeQueue;
                  fields.forEach(function(field){
                      if(temp[field] === undefined){
                          temp[field] = re.state.news[field]
                      }
                  });
                  
                  // Grab the ID
                  temp.NID = re.state.news.NID;
                  // Send the blob of info
                  $.post(post, {
                      msg: "edit",
                      NID: temp.NID,
                      Title:temp.Title,
                      Date:temp.Date,
                      Content:temp.Content,
                      ImageSrc:temp.ImageSrc
                      
                  }, function(data) {
                      data = JSON.parse(data);
                      if(data.status !== "success"){
                          alert("Edit was not successful");
                          return;
                      }
                      var newNews = {};
                      // If successful edit, reflect changes in UI
                      for(var field in temp){
                         newNews[field] = temp[field];
                      }
                      newNews.NID = re.state.news.NID;
                      re.setState({
                          editMode:false,
                          news:newNews,
                          changeQueue:{},
                      });
                      
                  }.bind(re));
               }}>Add</button>
               
               <button onClick={function(){
                   re.setState({
                       editMode:false,
                       changeQueue:{}
                   });
               }}>Cancel</button>
            </div>
         </div>)
        }
        return (<div className="event card blue darken-4">
                  <div className="card-content white-text">
                     <div className="card-image image-src">
              <img src={this.state.news.ImageSrc}/>
            </div>
                     <span className="card-title">{this.state.news.Title}</span>
                     <p/>
                        <span className="eventLogistics">{this.state.news.Date}</span>
                     <p/>
                        <span>{this.state.news.Content}</span>
                  </div>
                  <div className="card-action">
                     <button onClick={this.handleEdit}>Edit</button>
                     <button onClick={this.handleDelete}>Delete</button>
                  </div>
               </div>);
    }
})

var NewsList = React.createClass({
    getInitialState: function() {
        return {
            news:[]
        };
    },

    componentDidMount: function() {
        $.get(this.props.source,{msg:"query"},function(data){
            data = JSON.parse(data);

            this.setState({
                news:data
            });
        }.bind(this));
    },

    render: function() {
        var re = this;
        if(this.state.news.length <= 0 ){
            return null;
        }
        var nodes =  this.state.news.map(function(e){
            return (<News
            news = {e}
            key={e.NID}
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
        return (  <div id="newsForm" className="">
    <button onClick={this.onClick} className="btn"> {this.state.show ? "Cancel" : "Add a News/Annoucement"} </button>
    {this.state.show ? <NewsForm/> : null}
    </div>)
    }
});

var NewsForm = React.createClass({
    getInitialState: function() {
      return {userInput: ''};
    },
    handleSubmit:function(e){
        e.preventDefault();
        var re = this;
        var form = new FormData();
        var file = this.refs.ImageFile.getDOMNode().files[0];
        form.append("file",file);
        var data = {
            Title:React.findDOMNode(re.refs.Title).value,
            Date:React.findDOMNode(re.refs.Date).value,
            Content:React.findDOMNode(re.refs.Content).value,
            ImageSrc:React.findDOMNode(re.refs.ImageSrc).value,
            msg:"insert"
        };
        for(var field in data){
            console.log(data[field]);
            form.append(field,data[field]);
        }
        var xhr = new XMLHttpRequest();
        xhr.open('POST', post, true);
        xhr.onload = function() {
          if (this.status == 200) {
              var data = JSON.parse(this.response);
              if(data.status == "success"){
                  window.location.reload();
              }
          };
      };
      
      xhr.send(form);
    },
    render:function(){
        return (
    <div className="formWrapper">
        <div className="row">
          <div className="col s6 offset-s2">
                  <h2 className="header">Add a News/Annoucement</h2>
          </div>
        </div>
        <form encType="multipart/form-data" id="test" >
        <div className="row">
      <div className="col s4 offset-s2">
        <label>Title</label>
        <input type="text" ref="Title"/>
      </div>
      <div className="col s4">
        <label> Date</label>
        <input type="date" ref="Date"/>
      </div>
    </div>

    <div className="row">
      <div className="col s4 offset-s2">
        <label>Image Url</label>
        <input type="text" ref="ImageSrc"/>
      </div>
      <div className="col s4">
        <label>Image File</label>
        <p/>
        <input type="file" ref="ImageFile"/>
      </div>
    </div>
    <div className="row">
          <div className="col s4 offset-s2">
        <label>Content</label>
        <textarea className="materialize-textarea" ref="Content"></textarea>
      </div>
    </div>
        <div className="row">
        <div className="col s4 offset-s2">
      <button className="btn" onClick={this.handleSubmit}>Submit</button>
      </div>
    </div>
    </form>
    </div>
    );
    },
}); 


React.render( <NewsList source = "https://new-sase-dahnny012.c9.io/API/news.php"/> 
, document.getElementById("news"));



React.render(<Modal/>,document.getElementById("Modal"));

